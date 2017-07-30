FROM mysql:latest

# Copy the database initialize script:
# Contents of /docker-entrypoint-initdb.d are run on mysqld startup
ADD  docker-entrypoint-initdb.d/ /docker-entrypoint-initdb.d/

# Default values for passwords and database name. Can be overridden on docker run
# ENV MYSQL_ROOT_PASSWORD=my-secret-pw # Not defaulted for security reasons!
ENV MYSQL_DATABASE=ypk
ENV MYSQL_USER=hepengfei
ENV MYSQL_PASSWORD=hpf

# docker build -f Dockerfile -t ypksql .
# docker run -it -p 3306:3306 ypksql bash