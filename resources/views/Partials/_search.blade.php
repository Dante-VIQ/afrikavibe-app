<script>
    function search() {
        const query = document.getElementById('searchQuery').value;

        fetch('/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ query })
        })
        .then(response => response.json())
        .then(data => {
            let resultsHtml = '';

            data.results.forEach(result => {
                resultsHtml += '<div class="mt-2 p-2 border rounded">${result.title}</div>';
            });

            document.getElementById('searchResults').innerHTML = resultsHtml;
        });
    }
</script>
