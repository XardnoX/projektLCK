<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stranka dvě</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1 style="text-align:center;width:100%">Tabulka "kategorie" z databáze</h1>
    <table class="table table-dark table-striped" style="text-align:center;width:100%">
        <thead>
            <tr>
                <th>název</th>
                <th>popis</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
        @foreach($customerData as $cd)
            <tr>
                <td>{{ $cd->nazev }}</td>
                <td>{{ $cd->popis }}</td>
                <td>
                <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $cd->id }}" onclick="setFormAction('{{ $cd->id }}')">Smazat</button>
                <td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/index" class="btn btn-primary">Přejít na index</a>
</div>

<!-- Modal Confirmation -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Potvrdit smazání</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Chcete doopravdy smazat kategorii "{{ $cd->nazev}}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                <form id="deleteForm" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline btn-danger" type="submit" id="deleteButton1">Smazat</button>
</form>
            </div>
        </div>
    </div>
</div>





<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname === '/kategorie') {
        var form = document.getElementById('deleteForm');

        // Attach event listeners to delete buttons
        document.querySelectorAll('.delete-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Retrieve the category ID from the button's data-id attribute
                var kategorieId = this.getAttribute('data-id');
                
                // Set the form's action attribute
                form.action = '/kategorie/' + kategorieId;

                // Optional: Log the set action for debugging
                console.log("Form action set for category ID: " + kategorieId);
            });
        });
    }
});


    </script>
</body>

</html>
