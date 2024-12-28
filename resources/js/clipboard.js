import { CopyClipboard, Tooltip } from 'flowbite';

document.addEventListener('DOMContentLoaded', function () {
    const copyableFields = ['name-person-id', 'ap-person-id', 'am-person-id'];

    copyableFields.forEach(fieldId => {
        const button = document.querySelector(`[data-copy-to-clipboard-target="${fieldId}"]`);
        const target = document.getElementById(fieldId);

        if (button && target) {
            const clipboard = new CopyClipboard(button, target);

            const defaultIcon = document.getElementById(`default-icon-${fieldId}`);
            const successIcon = document.getElementById(`success-icon-${fieldId}`);
            const tooltipElement = document.getElementById(`tooltip-${fieldId}`);
            const defaultTooltipMessage = document.getElementById(`default-tooltip-message-${fieldId}`);
            const successTooltipMessage = document.getElementById(`success-tooltip-message-${fieldId}`);

            if (tooltipElement) {
                const tooltip = new Tooltip(tooltipElement);
            }

            clipboard.updateOnCopyCallback(() => {
                defaultIcon.classList.add('hidden');
                successIcon.classList.remove('hidden');
                defaultTooltipMessage.classList.add('hidden');
                successTooltipMessage.classList.remove('hidden');

                // Reset to default state after 2 seconds
                setTimeout(() => {
                    defaultIcon.classList.remove('hidden');
                    successIcon.classList.add('hidden');
                    defaultTooltipMessage.classList.remove('hidden');
                    successTooltipMessage.classList.add('hidden');
                }, 2000);
            });
        }
    });
});
