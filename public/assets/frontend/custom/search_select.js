
  document.addEventListener('DOMContentLoaded', function() {
      const customSelect = document.querySelector('.custom-select_1');
      const selectDropdown = document.querySelector('.select-dropdown_1');
      const selectSearch = document.querySelector('.select-search_1');
      const selectOptions = document.querySelectorAll('.select-option_1');

      customSelect.addEventListener('click', function() {
          selectDropdown.classList.toggle('open');
          selectSearch.value = '';
          filterOptions('');
      });

      selectSearch.addEventListener('input', function() {
          filterOptions(this.value);
      });

      selectOptions.forEach(option => {
          option.addEventListener('click', function() {
              customSelect.value = this.textContent;
              selectDropdown.classList.remove('open');
          });
      });

      document.addEventListener('click', function(event) {
          if (!customSelect.contains(event.target) && !selectDropdown.contains(event.target)) {
              selectDropdown.classList.remove('open');
          }
      });

      function filterOptions(searchText) {
          selectOptions.forEach(option => {
              if (option.textContent.toLowerCase().includes(searchText.toLowerCase())) {
                  option.style.display = 'block';
              } else {
                  option.style.display = 'none';
              }
          });
      }
  });

  document.addEventListener('DOMContentLoaded', function() {
      const customSelect = document.querySelector('.custom-select_2');
      const selectDropdown = document.querySelector('.select-dropdown_2');
      const selectSearch = document.querySelector('.select-search_2');
      const selectOptions = document.querySelectorAll('.select-option_2');

      customSelect.addEventListener('click', function() {
          selectDropdown.classList.toggle('open');
          selectSearch.value = '';
          filterOptions('');
      });

      selectSearch.addEventListener('input', function() {
          filterOptions(this.value);
      });

      selectOptions.forEach(option => {
          option.addEventListener('click', function() {
              customSelect.value = this.textContent;
              selectDropdown.classList.remove('open');
          });
      });

      document.addEventListener('click', function(event) {
          if (!customSelect.contains(event.target) && !selectDropdown.contains(event.target)) {
              selectDropdown.classList.remove('open');
          }
      });

      function filterOptions(searchText) {
          selectOptions.forEach(option => {
              if (option.textContent.toLowerCase().includes(searchText.toLowerCase())) {
                  option.style.display = 'block';
              } else {
                  option.style.display = 'none';
              }
          });
      }
  });

    document.addEventListener('DOMContentLoaded', function() {
        const customSelect = document.querySelector('.custom-select_3');
        const selectDropdown = document.querySelector('.select-dropdown_3');
        const selectSearch = document.querySelector('.select-search_3');
        const selectOptions = document.querySelectorAll('.select-option_3');
  
        customSelect.addEventListener('click', function() {
            selectDropdown.classList.toggle('open');
            selectSearch.value = '';
            filterOptions('');
        });
  
        selectSearch.addEventListener('input', function() {
            filterOptions(this.value);
        });
  
        selectOptions.forEach(option => {
            option.addEventListener('click', function() {
                customSelect.value = this.textContent;
                selectDropdown.classList.remove('open');
            });
        });
  
        document.addEventListener('click', function(event) {
            if (!customSelect.contains(event.target) && !selectDropdown.contains(event.target)) {
                selectDropdown.classList.remove('open');
            }
        });
  
        function filterOptions(searchText) {
            selectOptions.forEach(option => {
                if (option.textContent.toLowerCase().includes(searchText.toLowerCase())) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const customSelect = document.querySelector('.custom-select_4');
        const selectDropdown = document.querySelector('.select-dropdown_4');
        const selectSearch = document.querySelector('.select-search_4');
        const selectOptions = document.querySelectorAll('.select-option_4');
  
        customSelect.addEventListener('click', function() {
            selectDropdown.classList.toggle('open');
            selectSearch.value = '';
            filterOptions('');
        });
  
        selectSearch.addEventListener('input', function() {
            filterOptions(this.value);
        });
  
        selectOptions.forEach(option => {
            option.addEventListener('click', function() {
                customSelect.value = this.textContent;
                selectDropdown.classList.remove('open');
            });
        });
  
        document.addEventListener('click', function(event) {
            if (!customSelect.contains(event.target) && !selectDropdown.contains(event.target)) {
                selectDropdown.classList.remove('open');
            }
        });
  
        function filterOptions(searchText) {
            selectOptions.forEach(option => {
                if (option.textContent.toLowerCase().includes(searchText.toLowerCase())) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }
    });
