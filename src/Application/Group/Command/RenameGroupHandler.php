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

namespace App\Application\Group\Command;

use App\Application\Group\Repository\Groups;

final class RenameGroupHandler
{
    /**
     * @var Groups
     */
    private $groups;

    public function __construct(Groups $groups)
    {
        $this->groups = $groups;
    }

    public function __invoke(RenameGroup $renameGroup): void
    {
        $group = $this->groups->get($renameGroup->groupId());

        $group->rename($renameGroup->name());

        $this->groups->save($group);
    }
}
