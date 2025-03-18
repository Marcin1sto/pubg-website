FROM oven/bun:1 as base

WORKDIR /app
ENV NODE_ENV=development

FROM base as build
COPY package.json bun.lock ./
RUN bun install

FROM base
COPY --from=build /app/node_modules /app/node_modules

EXPOSE 3000

ENV CHOKIDAR_USEPOLLING=true
CMD ["bun", "run", "dev", "--host", "0.0.0.0"]