# 🚀 DevPulse API

The high-performance, containerized backend powering the DevPulse ecosystem. Built with **Laravel 12** and orchestrated on **AWS**.

---

## 🏗 System Architecture

DevPulse follows a **decoupled architecture**, separating the data layer from the user experience for maximum scalability.

### 1️⃣ Application Stack
* **Language:** PHP 8.4 (Latest)
* **Framework:** Laravel 12
* **Runtime:** Dockerized Environment
* **Database:** PostgreSQL (AWS RDS)

---

## ☁️ Cloud Infrastructure (AWS)

This project is engineered to handle production-grade traffic using a serverless-first approach on Amazon Web Services.

### **Compute & Orchestration**
* **AWS ECS (Fargate):** Manages container lifecycles without the overhead of managing EC2 instances.
* **Elastic Container Registry (ECR):** Private storage for production Docker images.

### **Networking & Security**
* **Application Load Balancer (ALB):** Handles SSL termination and intelligent routing.
* **ACM (Certificate Manager):** Multi-level wildcard certificates securing `mbilal.ca` and its subdomains.
* **VPC Isolation:** Strict security groups ensure the database is never exposed to the public internet.

---

## 🛠 DevOps & Automation

We prioritize **Developer Experience (DX)** and consistent deployments.

* **Automated Deployments:** A custom `deploy.sh` script automates the build, push, and service update cycle.
* **Zero-Downtime:** ECS handles rolling updates, ensuring the API is always available during new releases.



---

## 🔗 Environment Links

| Resource | URL |
| :--- | :--- |
| **Main Portfolio** | [mbilal.ca](https://mbilal.ca) |
| **API Endpoint** | [api.devpulse.mbilal.ca](https://api.devpulse.mbilal.ca) |
| **API Docs** | `/api/documentation` |
