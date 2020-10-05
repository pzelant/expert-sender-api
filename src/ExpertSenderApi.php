<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi;

use Pzelant\ExpertSenderApi\Enum\BouncesGetRequest\BounceType;
use Pzelant\ExpertSenderApi\Request\BouncesGetRequest;
use Pzelant\ExpertSenderApi\Request\TimeGetRequest;
use Pzelant\ExpertSenderApi\Resource\DataTablesResource;
use Pzelant\ExpertSenderApi\Resource\MessagesResource;
use Pzelant\ExpertSenderApi\Resource\SubscribersResource;
use Pzelant\ExpertSenderApi\Response\BouncesGetResponse;
use Pzelant\ExpertSenderApi\Response\TimeGetResponse;

/**
 * Expert Sender API
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class ExpertSenderApi
{
    /**
     * @var RequestSenderInterface Request sender
     */
    private $requestSender;

    /**
     * Constructor.
     *
     * @param RequestSenderInterface $requestSender Request sender
     */
    public function __construct(RequestSenderInterface $requestSender)
    {
        $this->requestSender = $requestSender;
    }

    /**
     * Get Subscribers resource
     *
     * @return SubscribersResource Subscribers resource
     */
    public function subscribers(): SubscribersResource
    {
        return new SubscribersResource($this->requestSender);
    }

    /**
     * Get server time response
     *
     * @return TimeGetResponse Server time response
     */
    public function getServerTime(): TimeGetResponse
    {
        return new TimeGetResponse($this->requestSender->send(new TimeGetRequest()));
    }

    /**
     * Get bounces data
     *
     * @param \DateTime $startDate Start date
     * @param \DateTime $endDate End date
     * @param BounceType|null $bounceType Bounce type
     *
     * @return BouncesGetResponse Bounces data
     */
    public function getBouncesList(
        \DateTime $startDate,
        \DateTime $endDate,
        BounceType $bounceType = null
    ): BouncesGetResponse {
        return new BouncesGetResponse(
            $this->requestSender->send(new BouncesGetRequest($startDate, $endDate, $bounceType))
        );
    }

    /**
     * Get data tables resource
     *
     * @return DataTablesResource Data tables resource
     */
    public function dataTables(): DataTablesResource
    {
        return new DataTablesResource($this->requestSender);
    }

    /**
     * Get messages resource
     *
     * @return MessagesResource Messages resource
     */
    public function messages(): MessagesResource
    {
        return new MessagesResource($this->requestSender);
    }
}
