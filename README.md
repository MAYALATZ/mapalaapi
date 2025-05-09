Instructions for building and running the front-end containers. 


Docker and Docker Compose installed

Internet connection (for installing packages and downloading base images)
uild the Front-End Docker Image
Each front-end container is built from a custom Dockerfile that serves the React app using NGINX.
Navigate to your frontend directory:
Command
cd  mayalaapi.php
Build the Docker image.
docker build -t mayalaapi-app
Run the Front-End Containers via Docker Compose
Navigate to your project root (where docker-compose.yml is located)
cd ..
Run all containers (load balancer, 3 frontends, API, database):
docker compose up -d --build
Build and run three front-end containers (e.g., frontend1, frontend2, frontend3)
Access the Front-End
http:// ec2-44-220-153-100.compute-1.amazonaws.com  44.220.153.100

Load Balancer Setup (Round-Robin with Health Checks)
Load Balancer Overview
This project uses NGINX as a reverse proxy load balancer to distribute traffic evenly across three front-end React containers using the round-robin algorithm.
 Round-Robin Algorithm
NGINX is configured to send incoming HTTP requests to the three front-end services in a rotating (round-robin) order.
Request 1 → frontend1
Request 2 → frontend2
Request 3 → frontend3
Request 4 → frontend1 (again)
NGINX Load Balancer Configuration (nginx.conf)
Located in nginx-loadbalancer/nginx.conf, it contains:
Health Checks (Optional Enhancement)
For production-level availability, NGINX can be extended with health checks using modules like nginx_upstream_check_module. However, 
basic container health checks can be defined in 
docker-compose.yml
 nginx.conf and docker-compose.yml
 Certainly! Here's a tailored `README.md` section for your assignment, based on your setup, titled:

Instructions for Deploying the Environment on AWS EC2

This section explains how to deploy the load-balanced front-end application, along with the APIand database, on anAWS Free Tier EC2 Ubuntu instance using Docker and Docker Compose.

An AWS account
 EC2 Ubuntu 20.04 instance (t2.micro)
Docker and Docker Compose installed on the EC2 instance
Port 80 opened in the EC2 security group (for HTTP access)
Steps to Deploy
SSH into chmod 400 "intersoft-pem-key.pem"

ssh chmod 400 "intersoft-pem-key.pem

 Replace `your-key.pem` and IP with yo

git clone https://github.com/MAYALATZ/assignment4-frontend.git
cd assignment4-frontend
Build and Run the Docker Environme
docker compose up -d --build

 Builds all Docker images (API, frontend, load balancer)
 Starts containers: 3 frontends, 1 API, 1 MySQL (or your DB), and the load balancer
 Automatically connects containers via Docker networks
Access the Front-End
In your browser, go to
http://ec2-44-220-153-100.compute-1.amazonaws.com  -44.220.153.100
 The homepage with Students and Courses buttons
 Dynamic display of data from `/students` and `/subjects` API
 The `X-Node-ID` showing which front-end instance served the request
Verify Load Balancing (Round-Robin)
Refresh the homepage multiple times
 Observe that `X-Node-ID` changes between `frontend1`, `frontend2`, `frontend3`
 Stop one front-end container (e.g., `docker stop frontend2`) and refresh again
 The load balancer will continue distributing traffic to the remaining healthy nodes







