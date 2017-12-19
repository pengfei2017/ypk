FROM hepengfei2017/alpine-node:0.10.48

# ENV PATH="/usr/bin/node:${PATH}"

ADD im /im

WORKDIR /im

EXPOSE 8096

CMD ["node","-v"]


# docker build -f Dockerfile -t node_chat_server .
# docker run -it -p 3306:3306 node_chat_server bash
# docker run -it node_chat_server bash