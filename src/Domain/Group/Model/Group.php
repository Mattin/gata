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

namespace App\Domain\Group\Model;

use App\Domain\AggregateRoot;
use App\Domain\Group\Event\GroupAdded;
use App\Domain\Group\Event\GroupRenamed;
use App\Domain\Idea\Model\Idea;
use App\Domain\Idea\Model\IdeaDescription;
use App\Domain\Idea\Model\IdeaId;
use App\Domain\Idea\Model\IdeaTitle;

class Group extends AggregateRoot
{
    /**
     * @var GroupId
     */
    private $groupId;

    /**
     * @var GroupName
     */
    private $name;

    public static function add(GroupId $groupId, GroupName $groupName): self
    {
        $group = new self();

        $group->recordThat(GroupAdded::withData($groupId, $groupName));

        return $group;
    }

    public function __toString(): string
    {
        return $this->name()->value();
    }

    public function groupId(): GroupId
    {
        return $this->groupId;
    }

    public function name(): GroupName
    {
        return $this->name;
    }

    public function rename(GroupName $groupName): void
    {
        $this->recordThat(GroupRenamed::withData($this->groupId(), $groupName));
    }

    public function addIdea(
        IdeaId $ideaId,
        IdeaTitle $ideaTitle,
        IdeaDescription $ideaDescription
    ): Idea {
        return Idea::add(
            $ideaId,
            $this->groupId(),
            $ideaTitle,
            $ideaDescription
        );
    }

    protected function aggregateId(): string
    {
        return $this->groupId()->value();
    }

    protected function applyGroupAdded(GroupAdded $event): void
    {
        $this->groupId = $event->groupId();
        $this->name = $event->name();
    }

    protected function applyGroupRenamed(GroupRenamed $event): void
    {
        $this->name = $event->name();
    }
}
