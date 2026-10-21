<?php
declare(strict_types=1);

namespace App\Controller;

use App\Enum\TaskPriorityEnum;
use App\Enum\TaskStatusEnum;
use Cake\Http\Response;

/**
 * Pages Controller
 *
 * Public pages that do not belong to any resource.
 */
class PagesController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['home']);
    }

    /**
     * Landing page. Logged in users go straight to their board.
     *
     * @return \Cake\Http\Response|null
     */
    public function home(): ?Response
    {
        if ($this->currentUserId() !== null) {
            return $this->redirect(['controller' => 'Tasks', 'action' => 'index']);
        }

        $statuses = TaskStatusEnum::getStatuses();
        $priorities = TaskPriorityEnum::getPriorities();

        $this->set(compact('statuses', 'priorities'));

        return null;
    }
}
