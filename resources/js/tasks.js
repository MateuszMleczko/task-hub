import Sortable from 'sortablejs';

document.addEventListener('DOMContentLoaded', () => {
    const board = document.querySelector('.tasks__board');
    if (!board) return;

    const refreshCounts = () => {
        board.querySelectorAll('.tasks__column').forEach((column) => {
            const count = column.querySelector('.tasks__column-count');
            const list = column.querySelector('.tasks__list');

            if (count && list) {
                count.textContent = list.children.length;
            }
        });
    };

    const changeStatus = async (taskId, status) => {
        const response = await fetch(`${board.dataset.statusUrl}/${taskId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': board.dataset.csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ status: status }),
        });

        if (!response.ok) {
            throw new Error('The status could not be changed.');
        }
    };

    board.querySelectorAll('.tasks__list').forEach((list) => {
        new Sortable(list, {
            group: 'tasks',
            animation: 150,
            ghostClass: 'task-card--ghost',
            chosenClass: 'task-card--chosen',
            dragClass: 'task-card--drag',
            onEnd: (event) => {
                if (event.to === event.from) return;

                refreshCounts();

                changeStatus(event.item.dataset.taskId, event.to.dataset.status).catch(() => {
                    event.from.insertBefore(event.item, event.from.children[event.oldIndex] ?? null);
                    refreshCounts();
                });
            },
        });
    });
});
