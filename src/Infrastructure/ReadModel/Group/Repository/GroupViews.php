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

namespace App\Infrastructure\ReadModel\Group\Repository;

use App\Domain\Group\Model\GroupId;
use App\Infrastructure\ReadModel\Group\View\GroupView;

interface GroupViews
{
    public function add(GroupView $groupView): void;

    public function get(GroupId $groupId): GroupView;

    public function save(): void;
}
