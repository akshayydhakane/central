k8s detail lab -

curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube-linux-amd64
sudo install minikube-linux-amd64 /usr/local/bin/minikube
sudo apt install docker.io
systemctl start docker
minikube start --driver=docker
sudo usermod -aG docker ubuntu && newgrp docker
sudo snap install kubectl --classic
kubectl get pod -A
git clone https://github.com/thunderstom/django-notes-app.git
git remote -v
docker build -t akshay12323/todo:v1 .
docker run -it -p 8000:8000 image id 
docker push akshay12323/todo:v1
vi pod.yml
apiVersion: v1
kind: Pod
metadata:
  name: todo-app
spec:
  containers:
  - name: todo-app
    image: akshay12323/todo:v1
    ports:
    - containerPort: 8000
	
docker run -d akshay12323/todo:v1 --name todo-app -p 8000:8000

:wq
kubectl create -f pod.yml
kubectl get pods
kubectl get pods -o wide
minikube ssh
curl -L http://ipadress:8000
kubectl logs akshay12323/todo:v1
kubectl describe pod akshay12323/todo:v1
kubectl get all -A
vi deploy.yml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: todo-app
  labels:
    app: nginx (this is labels imp.)
spec:
  replicas: 2
  selector:
    matchLabels:
      app: nginx
  template:
    metadata:
      labels:
        app: nginx
    spec:
      containers:
      - name: todo-app
        image: akshay12323/todo:v1
        ports:
        - containerPort: 8000
		
:wq
kubectl apply -f deploy.yml
kubectl get deploy
kubectl get rs						
kubectl delete pod (podid)
kubectl get pods -w
kubectl get pods          or       kubectl get pods v=9
vi service.yml
apiVersion: v1
kind: Service
metadata:
  name: todo-service
spec:
  type: NodePort
  selector:
    app: nginx(this is label copy from pod file)
  ports:
    - protocol: TCP
      port: 80
      targetPort: 8000
	  nodePort:31000
	
:wq 
kubectl apply -f service.yml
kubectl get svc	
minikube ssh
curl -L ipadress:31000
minikube ip 
curl -L ipadress(paste any ip):31000
kubectl edit svc todo-service
*here do some changes
*search /NodePort in command line
selector:
	app:...
   sessionA....
   type:LoadBalancer      -----edited
:wq
kubectl get svc

install kubeshark and up it
