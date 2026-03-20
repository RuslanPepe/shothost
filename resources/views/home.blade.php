<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<nav class="navbar header">
    <div class="container-fluid justify-content-center">
        <p class="navbar-brand text-white" style="margin: 0">
            HostShot
        </p>
    </div>
</nav>

<div class="container mt-4">

    <div class="upload-area" onclick="input.click()">
        Нажми или перетащи фото 📷
    </div>

    <input id="formFileMultiple" type="file" accept="image/*" multiple hidden>

    <div class="carousel-container">
        <button class="arrow left" id="scrollLeft">‹</button>
        <div id="preview" class="preview"></div>
        <button class="arrow right" id="scrollRight">›</button>
    </div>

    <div id="photoContainer"></div>
    <div class="row">
        <div class="col-12 d-flex">
            <button class="btn createLinks" id="createLinks" type="button">
                Создать ссылку
            </button>
            <button class="btn createSettings" id="createSettings" type="button" data-bs-toggle="modal" data-bs-target="#modalSettings">
                ⚙
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalSettings" tabindex="-1" aria-labelledby="modalSettingsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modalSettings">
                <div class="modal-header modalSettingsHeader">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Настройки ссылки</h1>
                    <button type="button" class="btn-close" data-bs-theme="dark" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="SettingsLink" method="post">
                    @CSRF
                    <div class="modal-body">
                        <div class="lifeTime ">
                            <div class="modalSettingsTitle" style="padding: 0 0 16px 0;">Life time</div>
                            <div class="d-flex gap-1">
                                <input type="radio" class="btn-check" name="lifetime" id="option1" value="1" autocomplete="off" checked>
                                <label class="btn btnSecondary" for="option1">1</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option2" value="3" autocomplete="off">
                                <label class="btn btnSecondary" for="option2">3</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option3" value="7" autocomplete="off">
                                <label class="btn btnSecondary" for="option3">7</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option4" value="14" autocomplete="off">
                                <label class="btn btnSecondary" for="option4">14</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option5" value="21" autocomplete="off">
                                <label class="btn btnSecondary" for="option5">21</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option6" value="30" autocomplete="off">
                                <label class="btn btnSecondary" for="option6">30</label>

                                <div style="">
                                    <input type="number" class="form-control inputLifeTime modalSettingsInput" id="lifetimeInput" min="0" max="365" aria-describedby="basic-addon1">
                                    <p style="position: absolute;">max: 365 days</p>
                                </div>

                            </div>
                        </div>

                        <div class="access">
                            <div class="modalSettingsTitle">Access</div>
                            <input type="radio" class="btn-check" name="access" id="access1" value="link" autocomplete="off" checked>
                            <label class="btn btnSecondary" for="access1">Link</label>

                            <input type="radio" class="btn-check" name="access" id="access2" value="private" autocomplete="off">
                            <label class="btn btnSecondary" for="access2">Private</label>

                            <input type="radio" class="btn-check" name="access" id="access3" value="password" autocomplete="off">
                            <label class="btn btnSecondary" for="access3">Password</label>
                        </div>

                        <div class="deleteAfter">
                            <div class="modalSettingsTitle" >Delete after day (без просмотра)</div>
                            <div class="inputModalSettings d-flex gap-1">
                                <input type="radio" class="btn-check" name="deleteAfter" id="deleteAfter1" value="0" autocomplete="off" checked>
                                <label class="btn btnSecondary" for="deleteAfter1">none</label>

                                <input type="radio" class="btn-check" name="deleteAfter" id="deleteAfter2" value="1" autocomplete="off">
                                <label class="btn btnSecondary" for="deleteAfter2">1</label>

                                <input type="radio" class="btn-check" name="deleteAfter" id="deleteAfter3" value="5" autocomplete="off">
                                <label class="btn btnSecondary" for="deleteAfter3">5</label>

                                <input type="radio" class="btn-check" name="deleteAfter" id="deleteAfter4" value="10" autocomplete="off">
                                <label class="btn btnSecondary" for="deleteAfter4">10</label>

                                <div>
                                    <input type="number" class="form-control inputDeleteAfter modalSettingsInput" id="deleteAfter5" min="0" max="365" aria-describedby="basic-addon1">
                                    <p style="position: absolute;">max: 365</p>
                                </div>

                            </div>
                        </div>

                        <div class="typeAccess">
                            <div class="modalSettingsTitle">Type access</div>
                            <div class="inputModalSettings d-flex gap-1">
                                <input type="radio" class="btn-check" name="typeAccess" id="typeAccess1" value="onlyView" autocomplete="off" checked>
                                <label class="btn btnSecondary" for="typeAccess1">Only view</label>

                                <input type="radio" class="btn-check" name="typeAccess" id="typeAccess2" value="all" autocomplete="off" >
                                <label class="btn btnSecondary" for="typeAccess2">All</label>

                            </div>
                        </div>

                        <div class="Title">
                            <div class="modalSettingsTitle">Title</div>
                            <input type="text" class="form-control modalSettingsInputTitle modalSettingsInput" value="" name="Title" id="Title">
                        </div>

                        <div class="Description">
                            <div class="modalSettingsTitle">Description</div>
                            <input type="text" class="form-control modalSettingsInputDescription modalSettingsInput" name="Description" id="Description">
                        </div>

                        <div class="CustomLink">
                            <div class="modalSettingsTitle">Custom link</div>
                            <div class="input-group mb-3">
                                <span class="input-group-text modalSettingsSpan" id="customLinkLabel">hostshot.net/</span>
                                <input type="text" aria-describedby="customLinkLabel" class="form-control modalSettingsInputCustomLink modalSettingsInput" name="CustomLink" id="CustomLink">
                            <div/>
                        </div>
                    </div>
                </form>
                <div class="modal-footer modalSettingsFooter">
                    <button type="button" class="btn modalSettingsBtn" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn modalSettingsBtn" id="SettingsLinkBtn">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('Photo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
