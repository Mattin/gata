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

use App\Application\Idea\Exception\IdeaNotFoundException;
use App\Application\Idea\Repository\Ideas;
use App\Domain\Idea\Model\Idea;

final class UnregisterIdeaAttendeeHandler
{
    /**
     * @var Ideas
     */
    private $ideas;

    public function __construct(Ideas $ideas)
    {
        $this->ideas = $ideas;
    }

    public function __invoke(UnregisterIdeaAttendee $unregisterIdeaAttendee): void
    {
        $idea = $this->ideas->get($unregisterIdeaAttendee->ideaId());

        if (!$idea instanceof Idea) {
            throw new IdeaNotFoundException();
        }

        $idea->unregisterAttendee($unregisterIdeaAttendee->userId());

        $this->ideas->save($idea);
    }
}
