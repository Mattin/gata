<?php

declare(strict_types=1);

/*
 * This file is part of the `gata` project.
 *
 * (c) Aula de Software Libre de la UCO <aulasoftwarelibre@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Idea\Command;

use App\Domain\Idea\Model\IdeaId;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadTrait;

final class AcceptIdea extends Command
{
    use PayloadTrait;

    public static function create(IdeaId $ideaId): self
    {
        return new self([
            'ideaId' => $ideaId->value(),
        ]);
    }

    public function ideaId(): IdeaId
    {
        return new IdeaId($this->payload()['ideaId']);
    }
}
