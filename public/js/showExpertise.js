document.addEventListener('DOMContentLoaded', function () {
    // Fetch the expertise from the JSON file
    fetch('/expertise.json') // Adjust the path if necessary
        .then((response) => response.json())
        .then((data) => {
            const expertiseSelect = document.getElementById('fieldExpertise'); // Update to fieldExpertise
            data.forEach((expertise) => {
                const option = document.createElement('option');
                option.value = expertise.name;
                option.text = expertise.name;
                expertiseSelect.appendChild(option);
            });
        })
        .catch((error) => console.error('Error loading expertise:', error));
});
