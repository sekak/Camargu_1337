FROM debian:latest

RUN apt-get update && \
    apt-get install -y mariadb-server && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY ./mariadb/50-server.cnf /etc/mysql/mariadb.conf.d/

COPY ./mariadb/script.sh /script.sh

RUN chmod +x /script.sh

EXPOSE 3306

CMD ["/script.sh"]
