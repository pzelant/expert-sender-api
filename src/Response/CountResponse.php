<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response with count info
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class CountResponse extends SpecificXmlMethodResponse
{
    /**
     * Get count
     *
     * @return int Count
     */
    public function getCount(): int
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        return intval($this->getSimpleXml()->xpath('/ApiResponse/Count')[0]);
    }
}
