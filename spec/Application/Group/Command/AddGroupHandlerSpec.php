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

namespace spec\App\Application\Group\Command;

use App\Application\Group\Command\AddGroup;
use App\Application\Group\Repository\Groups;
use App\Domain\Group\Model\Group;
use App\Domain\Group\Model\GroupId;
use App\Domain\Group\Model\GroupName;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class AddGroupHandlerSpec extends ObjectBehavior
{
    const GROUP_ID = 'e8a68535-3e17-468f-acc3-8a3e0fa04a59';

    public function let(Groups $groups): void
    {
        $this->beConstructedWith($groups);
    }

    public function it_creates_a_group(Groups $groups): void
    {
        $groups->save(Argument::that(
            function (Group $group) {
                return $group->groupId()->equals(new GroupId(self::GROUP_ID))
                    && $group->name()->equals(new GroupName('Name'))
                ;
            }
        ))->shouldBeCalled();

        $this(AddGroup::create(
            new GroupId(self::GROUP_ID),
            new GroupName('Name')
        ));
    }
}
