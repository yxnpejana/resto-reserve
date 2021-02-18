# base image
FROM node:lts-slim
WORKDIR /var/www/frontend
ENV PATH /var/www/frontend/node_modules/.bin:$PATH
COPY ./src/frontend /var/www/frontend
RUN yarn global add @vue/cli
RUN yarn --save
EXPOSE 8080
CMD [ "yarn", "serve" ]
