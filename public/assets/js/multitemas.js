
        var searchBox = document.getElementById('search-box');
        var temasInput = document.getElementById('temas');
        var suggestionsContainer = document.querySelector('.suggestions');
        var selectedItemsContainer = document.getElementById('selected-items');
        var selectedItems = [];
        var initialSuggestions = [];

        function showSuggestions() {
            suggestionsContainer.innerHTML = '';
            var input = searchBox.value.toLowerCase();
            initialSuggestions.forEach(function(suggestion) {
                if (!selectedItems.includes(suggestion) && suggestion.toLowerCase().includes(input)) {
                    var span = document.createElement('span');
                    span.textContent = suggestion;
                    span.classList.add('suggestion');
                    suggestionsContainer.appendChild(span);
                }
            });
            suggestionsContainer.style.display = 'block';
        }

        searchBox.addEventListener('input', showSuggestions);
        searchBox.addEventListener('focus', showSuggestions);

        function updateTemasInput() {
            temasInput.value = selectedItems.join(', ');
        }

        function updateSelectedItems() {
            selectedItemsContainer.innerHTML = '';
            selectedItems.forEach(function(item) {
                var chip = document.createElement('span');
                chip.className = 'selected-item';
                chip.textContent = item;

                var removeBtn = document.createElement('span');
                removeBtn.className = 'remove';
                removeBtn.textContent = 'x';
                removeBtn.onclick = function() {
                    selectedItems = selectedItems.filter(function(val) {
                        return val !== item;
                    });
                    updateSelectedItems();
                    updateTemasInput();
                    showSuggestions();
                };

                chip.appendChild(removeBtn);
                selectedItemsContainer.appendChild(chip);
            });
            updateTemasInput();
        }

        suggestionsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('suggestion')) {
                var selection = e.target.textContent;
                if (!selectedItems.includes(selection)) {
                    selectedItems.push(selection);
                    updateSelectedItems();
                }
                searchBox.value = '';
                showSuggestions();
            }
        });

        document.addEventListener('click', function(e) {
            if (!searchBox.contains(e.target) && !suggestionsContainer.contains(e.target) && e.target.id !== 'temas') {
                suggestionsContainer.style.display = 'none';
            }
        });

        // Función para cargar valores iniciales de 'temas' y actualizar las selecciones
        function loadInitialSelections() {
            if(!temasInput.value) return;

            var initialSelections = temasInput.value.split(',').map(function(item) {
                return item.trim(); // Eliminar espacios en blanco alrededor de los nombres
            });
            selectedItems = initialSelections;
            updateSelectedItems();
        }

        //document.addEventListener('DOMContentLoaded', loadInitialSelections);
        document.addEventListener('DOMContentLoaded', function() {
            // Cargar las sugerencias iniciales desde los elementos span.suggestion
            document.querySelectorAll('.suggestions span.suggestion').forEach(function(span) {
                initialSuggestions.push(span.textContent);
            });

            loadInitialSelections();
        });


    