<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Initialize Quill editor -->
<script>
    var quill = new Quill('#editor', {
        modules: {
            toolbar: [
            ['bold', 'italic', 'underline', 'strike'],  
            ['link', 'blockquote'],
            [{ list: 'ordered' }, { list: 'bullet' }]
            ]
        },
        placeholder: 'Write product description...',
        theme: 'snow'
    });
//This is for saving a post without publishing it, not finished
    $(function(){
        $('#save').click(function () {
            var mysave = $('.ql-editor').html();
            $('#hiddeninput').val(mysave);			
        });
    });

//Takes the content of the quill editor and puts it in a text area so it can be sent with the form
    $(function(){
        $('#publish').click(function () {
            var mysave = $('.ql-editor').html();
            $('#hiddeninput').val(mysave);			
        });
    });
			
</script>