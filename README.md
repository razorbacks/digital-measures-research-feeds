# Digital Measures Research Feeds

Microservice providing feeds for research data collected on https://www.digitalmeasures.com

## Installation

Pull the image from [Docker hub][dockerhub].

    docker pull wcob/digital-measures-research-feeds

Run the container on host port 2345.

    docker run --rm --publish 0.0.0.0:2345:80 \
        --env DIGITAL_MEASURES_USERNAME="username" \
        --env DIGITAL_MEASURES_PASSWORD="password" \
        --env MAIL_HOST="smtp.example.com" \
        --env MAIL_USERNAME="logger@example.com" \
        --env MAIL_PASSWORD="password" \
        --env EXCEPTION_MAILER_TO_ADDRESS="notify@example.com" \
        --env MAIL_FROM_ADDRESS="logger@example.com" \
        wcob/digital-measures-research-feeds

## Development

Build the container.

    ./docker/build.bash

[dockerhub]:https://hub.docker.com/r/wcob/digital-measures-research-feeds/
