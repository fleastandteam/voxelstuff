function toggle_shortcode() {

    ob_start();
    ?>
    <style>
        .toggle-this-css .elementor-widget-container .toggle-content {
            max-height: 100px;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out;
            position: relative;
        }

        .toggle-this-css .elementor-widget-container .toggle-content::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(to top, rgba(255,255,255,0.8), rgba(255,255,255,0));
            pointer-events: none;
        }

        .toggle-this-css .elementor-widget-container .toggle-content.open {
            max-height: none;
        }

        .toggle-this-css .elementor-widget-container .toggle-content.open::before {
            display: none;
        }

        .toggle-close {
            display: none;
        }

        .toggle-open {
            display: inline;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleItem = document.getElementById('toggle-this-id');
            const elementorContainer = toggleItem.querySelector('.elementor-widget-container');
            const toggleContent = document.createElement('div');
            toggleContent.className = 'toggle-content';
            toggleContent.style.overflow = 'hidden';
            toggleContent.style.maxHeight = '100px';
            toggleContent.style.transition = 'max-height 0.4s ease-in-out';

            while (elementorContainer.firstChild) {
                toggleContent.appendChild(elementorContainer.firstChild);
            }

            elementorContainer.appendChild(toggleContent);

            const toggleButton = document.createElement('a');
            toggleButton.href = 'javascript:void(0);';
            toggleButton.className = 'toggle-button';
            toggleButton.innerHTML = '<span class="toggle-open">Read More</span><span class="toggle-close">Read Less</span>';
            toggleButton.style.marginTop = '20px';

            elementorContainer.appendChild(toggleButton);

            const toggleOpen = toggleButton.querySelector('.toggle-open');
            const toggleClose = toggleButton.querySelector('.toggle-close');

            toggleButton.addEventListener('click', function() {
                if (toggleContent.classList.contains('open')) {
                    toggleContent.style.maxHeight = '100px';
                    toggleContent.classList.remove('open');
                    toggleOpen.style.display = 'inline';
                    toggleClose.style.display = 'none';
                } else {
                    toggleContent.style.maxHeight = toggleContent.scrollHeight + 'px';
                    toggleContent.classList.add('open');
                    toggleOpen.style.display = 'none';
                    toggleClose.style.display = 'inline';
                }
            });
        });
    </script>


    <div id="toggle-this-id" class="toggle-this-css">
        <div class="elementor-widget-container">
            <!-- Your content here will be moved to the toggle-content div by JavaScript -->
        </div>
    </div>
    <?php
    
    return ob_get_clean();
}
add_shortcode('toggle', 'toggle_shortcode');
