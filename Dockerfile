FROM oven/bun:1.2-alpine AS build
WORKDIR /app

COPY package.json bun.lock ./
RUN bun ci

COPY . .
RUN bun run build

# Garantiza que exista /app/build (si Astro generó dist, lo renombra)
RUN if [ -d dist ] && [ ! -d build ]; then mv dist build; fi

FROM nginx:alpine
COPY --from=build /app/build /usr/share/nginx/html

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
