$(document).ready(function () {
    $('#posts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: postsDataUrl,
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'slug', name: 'slug' },
            { data: 'body', name: 'body' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        dom: 'Bfrtip', // Show buttons and info
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']], // Define page length menu
        language: {
            info: 'Showing _START_ to _END_ of _TOTAL_ entries',
            infoFiltered: '(filtered from _MAX_ total entries)',
            search: '_INPUT_',
            searchPlaceholder: 'Search...',
        },
    });
});
