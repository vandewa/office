<!DOCTYPE html>

<head>
    <title>Signature Pad Example</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css">
    </link>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <link rel="stylesheet" type="text/css" src="http://keith-wood.name/css/jquery.signature.css"></link>
    <style type="text/css">
        .kbw-signature {
            width: 100%;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
            border: 1px solid #CED4DA; /* Menambahkan border hitam */
            border-radius: 5px; /* Menambahkan sudut membulat */
        }
    </style>
</head>

<body>
    {{-- <div class="container"> --}}
        {{-- <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <div class="card"> --}}
                    {{-- <div class="card-header">
                        <h5>laravel signature</h5>
                    </div> --}}
                    {{-- <div class="card-body"> --}}
                        <form action="{{ route('post.signature') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                {{-- <label for="">Signature:</label> --}}
                                {{-- <br> --}}
                                <div id="sig"></div>
                                <br>
                                <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                                <textarea name="tanda_tangan" id="signature" style="display: none;"></textarea>
                            </div>
                            <br>
                            <button class="btn btn-success" type="submit">Save</button>
                        </form>
                    {{-- </div>
                </div>
            </div>
        </div> --}}
    {{-- </div> --}}
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(event) {
            event.preventDefault();
            sig.signature('clear');
            $('#signature').val('');
        });
    </script>
</body>

</html>
