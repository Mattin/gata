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

namespace Tests\Service\Prooph\Plugin;

use Doctrine\Common\Collections\Collection;

interface EventsRecorder
{
    public function getLastMessage(): CollectedMessage;

    /**
     * @return Collection|CollectedMessage[]
     */
    public function getAllMessages(): Collection;
}
