#!/bin/bash

# Configuration
REGION="us-east-1"
ACCOUNT_ID="157658493027"
REPO_NAME="devpulse-api"
IMAGE_NAME="devpulse-api"
ECR_URI="${ACCOUNT_ID}.dkr.ecr.${REGION}.amazonaws.com/${REPO_NAME}"

echo "🚀 Starting Deployment Process..."

# 1. Ensure Repository Exists
echo "🔎 Checking for ECR repository: ${REPO_NAME}..."
aws ecr describe-repositories --repository-names ${REPO_NAME} --region ${REGION} > /dev/null 2>&1

if [ $? -ne 0 ]; then
    echo "⚠️  Repository not found. Creating ${REPO_NAME} in ${REGION}..."
    aws ecr create-repository --repository-name ${REPO_NAME} --region ${REGION}
else
    echo "✅ Repository exists."
fi

# 2. Authenticate
echo "🔑 Authenticating with AWS ECR..."
aws ecr get-login-password --region ${REGION} | docker login --username AWS --password-stdin ${ACCOUNT_ID}.dkr.ecr.${REGION}.amazonaws.com

# 3. Build
echo "📦 Building Docker image..."
docker build -t ${IMAGE_NAME} .

# 4. Tag
echo "🏷️  Tagging image..."
docker tag ${IMAGE_NAME}:latest ${ECR_URI}:latest

# 5. Push with Error Checking
echo "📤 Pushing to AWS..."
if docker push ${ECR_URI}:latest; then
    echo "✅ Success! Image is live at ${ECR_URI}:latest"
else
    echo "❌ ERROR: The push failed."
    exit 1
fi

# this line will only work for the cluster, do not put it in generic deploy.sh
aws ecs update-service --cluster devpulse-cluster --service devpulse-api-service --force-new-deployment --no-cli-pager
