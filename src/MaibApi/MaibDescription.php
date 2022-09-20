<?php

namespace Maib\MaibApi;

use GuzzleHttp\Command\Guzzle\Description;

class MaibDescription extends Description
{
    /**
     * @param array $options Custom options to apply to the description
     *     - formatter: Can provide a custom SchemaFormatter class
     */
    public function __construct( array $options = [ ])
    {
        $uri = empty($options['basePath']) ? '/ecomm/MerchantHandler' : $options['basePath'];
        parent::__construct( [
          'name'       => 'Maib API',
          'operations' => [
            'registerSmsTransaction'   => [
              'httpMethod'    => 'POST',
              'uri'           =>   $uri,
              'description'   => 'identifies the request for register SMS transaction',
              'responseModel' => 'getResponse',
              'parameters'    => [
                'command'        => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
                'amount'         => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'       => 12,
                ],
                'currency'       => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'       => 3,
                ],
                'client_ip_addr' => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'      => 15,
                ],
                'description'    => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 125,
                ],
                'language'       => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 32,
                ],
                'msg_type'    => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 3,
                ],
              ]
            ],
            'registerDmsAuthorization' => [
              'httpMethod'    => 'POST',
              'uri'           =>   $uri,
              'description'   => 'identifies the request for register DMS transaction',
              'responseModel' => 'getResponse',
              'parameters'    => [
                'command'        => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
                'amount'         => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'      => 12,
                ],
                'currency'       => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'      => 3,
                ],
                'client_ip_addr' => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'      => 15,

                ],
                'description'    => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 125,
                ],
                'language'       => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 32,
                ],
                'msg_type'    => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 3,
                ],
              ]
            ],
            'makeDMSTrans'             => [
              'httpMethod'    => 'POST',
              'uri'           =>   $uri,
              'description'   => 'identifies the request for execute DMS transaction',
              'responseModel' => 'getResponse',
              'parameters'    => [
                'command'        => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
                'trans_id'        => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
                'amount'         => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'      => 12,
                ],
                'currency'       => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'      => 3,
                ],
                'client_ip_addr' => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'      => 15,

                ],
                'description'    => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 125,
                ],
                'language'       => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 32,
                ],
                'msg_type'    => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 3,
                ],
              ]
            ],
            'getTransactionResult'     => [
              'httpMethod'    => 'POST',
              'uri'           =>   $uri,
              'description'   => 'identifies the request for get transaction result',
              'responseModel' => 'getResponse',
              'parameters'    => [
                'command'        => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
                'trans_id'       => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
                'client_ip_addr' => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                  'max'      => 15,

                ],
              ]
            ],
            'revertTransaction'        => [
              'httpMethod'    => 'POST',
              'uri'           =>   $uri,
              'description'   => 'identifies the request for revert transaction',
              'responseModel' => 'getResponse',
              'parameters'    => [
                'command'  => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
                'trans_id' => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
                'amount '  => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => false,
                  'max'      => 12,
                ],
              ]
            ],
            'closeDay'                 => [
              'httpMethod'    => 'POST',
              'uri'           =>   $uri,
              'description'   => 'End of business day',
              'responseModel' => 'getResponse',
              'parameters'    => [
                'command' => [
                  'type'     => 'string',
                  'location' => 'postField',
                  'required' => true,
                ],
              ]
            ],
          ],
          'models'     => [
            'getResponse' => [
              'type'       => 'object',
              'properties' => [
                'additionalProperties' => [
                  'location' => 'body'
                ]
              ]
            ]
          ]
        ], $options);
    }
}
