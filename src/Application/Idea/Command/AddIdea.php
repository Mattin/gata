<?php

/*
 * This file is part of the `gata` project.
 *
 * (c) Aula de Software Libre de la UCO <aulasoftwarelibre@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Idea\Command;

use App\Domain\Group\Model\GroupId;
use App\Domain\Idea\Model\IdeaDescription;
use App\Domain\Idea\Model\IdeaId;
use App\Domain\Idea\Model\IdeaTitle;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadTrait;

final class AddIdea extends Command
{
    use PayloadTrait;

    public static function create(
        IdeaId $ideaId,
        GroupId $groupId,
        IdeaTitle $ideaTitle,
        IdeaDescription $ideaDescription
    ) {
        return new self([
            'ideaId' => $ideaId->value(),
            'groupId' => $groupId->value(),
            'title' => $ideaTitle->value(),
            'description' => $ideaDescription->value(),
        ]);
    }

    public function ideaId()
    {
        return new IdeaId($this->payload()['ideaId']);
    }

    public function groupId()
    {
        return new GroupId($this->payload()['groupId']);
    }

    public function title()
    {
        return new IdeaTitle($this->payload()['title']);
    }

    public function description()
    {
        return new IdeaDescription($this->payload()['description']);
    }
}
