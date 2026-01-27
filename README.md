🏗 System Architecture
DevPulse is built using a modern, decoupled architecture designed for high availability, security, and scalability. It separates the concerns of data management (Backend) from the user experience (Frontend).

1. High-Level Stack
   Backend: Laravel 12 (PHP 8.4) running in a Dockerized environment.

Frontend: Next.js (React) deployed on Vercel.

Database: Managed PostgreSQL (AWS RDS).

Cloud Infrastructure: Amazon Web Services (AWS).

2. Infrastructure (AWS)
   The backend is hosted on AWS using a containerized workflow to ensure environment parity between development and production.

Compute: AWS ECS (Fargate) manages the lifecycle of the Docker containers, providing a serverless experience with automatic scaling.

Traffic Management: An Application Load Balancer (ALB) handles SSL termination and intelligently routes traffic based on host headers (e.g., api.devpulse.mbilal.ca).

Security: * SSL/TLS: Traffic is encrypted end-to-end via AWS Certificate Manager (ACM) using a multi-level wildcard certificate.

Networking: Resources are isolated within a custom VPC with strict Security Group rules, ensuring only the ALB can communicate with the application containers.

CI/CD: Automated deployment script (deploy.sh) handles the build process, ECR image pushing, and ECS service updates.

3. Data & Storage
   RDS: A managed PostgreSQL instance handles persistent data with automated backups.

S3: (Optional/Planned) Used for storing project assets and screenshots securely.

4. Domain & DNS Strategy
   The project utilizes a unified branding strategy across multiple subdomains:

mbilal.ca: Main portfolio frontend (Vercel).

api.devpulse.mbilal.ca: Project-specific backend API (AWS).

How to use this:
Open your README.md.

Paste this under your main project title.

Commit Message: docs: add detailed system architecture and infrastructure overview
