FROM hepengfei2017/alpine-node:0.10.48

# ENV PATH="/usr/bin/node:${PATH}"

ADD im /im

WORKDIR /im

EXPOSE 8096

CMD ["node","chat.js"]


# docker build -f Dockerfile -t node_chat_server .
# docker network ls
# docker run --network=dockerfiles_ypk-net -it node_chat_server