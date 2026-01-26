# 🚀 DevPulse API Cheat Sheet

## 🛠 Tech Stack
- **Backend:** Laravel 12 (Headless)
- **PHP:** 8.4
- **Database:** PostgreSQL
- **Server:** Nginx + PHP-FPM (managed by Supervisor)
- **Deployment:** Docker -> AWS ECR -> AWS ECS (Fargate)

## 🏗 Local Development
- **Running via Herd:** Just access `devpulse-api.test`
- **Testing Docker Build:** `docker build -t devpulse-api .`
- **Running Docker Locally:** `docker run -p 8080:80 devpulse-api`

## ☁️ Cloud Workflow (AWS)
- **Registry:** Amazon ECR (`us-east-1`)
- **URI:** `157658493027.dkr.ecr.us-east-1.amazonaws.com/devpulse-api`
- **Deploy Command:** `sh deploy.sh`

## 📧 Email Flow (Contact Form)
1. **Frontend:** Next.js sends JSON POST to `/api/contacts`.
2. **Persistence:** `ContactController` saves to DB (`contacts` table).
3. **Mailable:** `ContactReceived` renders Markdown with `replyTo`.
4. **Relay:** SMTP via Mailtrap (Sandbox) for testing.
