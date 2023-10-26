# hpropagate-symfony
This package automatically propagates HTTP headers from inbound to outbound HTTP requests.  It also will add a request ID to all monolog logs under `req.id` to follow the format used in our node services [here](https://github.com/vira-org/hpropagate)

## Requirements
- PHP >= 8.1
- Symfony 6.3.x

## The Why
We use a microservice architecture with a growing number of HTTP endpoints. We want to propagate certain HTTP headers received from the incoming HTTP requests to all subsequent outbound HTTP requests without the need for our engineers to do it programmatically in each service:

By default, the following headers are automatically propagated:

1. x-request-id. If the header is missing from the inbound request, it will be created with a UUID as value.

Apart from x-request-id, only headers received on the incoming request will be propagated to outbound calls.

## Installation

`composer require...`

## Configuration

There is some optional configuration to be able to propagate more headers than just `x-request-id`:

```yaml
# config/packages/vira_hpropagate.yaml
vira_hpropagate:
    headers_to_propagate:
      - x-my-custom-header
      - my-other-header
```


