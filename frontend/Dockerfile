# ---------- dev: Vite dev server + HMR ----------
FROM node:22-alpine AS dev

ARG UID=1000
ARG GID=1000
RUN apk add --no-cache shadow \
    && ( getent group ${GID} >/dev/null || groupmod -g ${GID} node ) \
    && ( usermod -u ${UID} -g ${GID} node || true ) \
    && mkdir -p /app/node_modules \
    && chown -R ${UID}:${GID} /app

WORKDIR /app
USER node

COPY --chown=node:node frontend/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
ENTRYPOINT ["sh", "/usr/local/bin/docker-entrypoint"]
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0", "--port", "7010"]

# ---------- build: hasil `vite build` ----------
FROM node:22-alpine AS build
WORKDIR /app
COPY frontend/package*.json ./
RUN npm ci
COPY frontend/ ./
ARG VITE_API_URL=http://localhost:7011
ENV VITE_API_URL=${VITE_API_URL}
RUN npm run build

# ---------- prod: static dist di-serve nginx ----------
FROM nginx:1.27-alpine AS prod
COPY docker/nginx/frontend.conf /etc/nginx/conf.d/default.conf
COPY --from=build /app/dist /usr/share/nginx/html
EXPOSE 80
