<?php include "config.php"; ?>
<?php include "comp/header.php" ?>

<!--Carrossel-->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8 col-xl-8">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner shadow-lg">
                        <div class="carousel-item active">
                                <img src="img/c1.jpg" class="d-block" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Opinião dos Torcedores</h5>
                                    <a class=""><button type="button" class="btn btn-danger mt-4">Veja Aqui!</button></a>
                                </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/c2.jpg" class="d-block" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>História da Fórmula 1</h5>
                                <a class=""><button type="button" class="btn btn-danger mt-4">Veja Aqui!</button></a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/c3.jpg" class="d-block" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Pontuação do Campeonato Atual</h5>
                                <a class=""><button type="button" class="btn btn-danger mt-4">Veja Aqui!</button></a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h1 class="text-center text-danger" style="margin-top: 100px; margin-bottom: 100px;">Últimas Notícias</h1>
    </div>
        
    <!--Conteudo-->
    <div class="container-fluid" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="row justify-content-center">

        <!--Cards-->
            <div class="card mb-3 border-danger col-xs-12 col-sm-10 col-md-10 col-lg-8 col-xl-8" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="img/card/1card.avif" class="img-fluid rounded-start m-3 rounded-3" alt="..." style="max-width: 100%;">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body ms-3">
                        <h5 class="card-title">F1 Abolirá Ponto Extra por Volta Mais Rápida em 2025</h5>
                        <p class="card-text">A FIA decidiu encerrar o sistema que, desde 2019, premiava a volta mais rápida. A mudança ocorre após polêmica no GP de Singapura, quando Ricciardo tirou o ponto de Norris, impactando a disputa pelo título.</p>
                        <p class="card-text"><small class="text-body-secondary">Notícia atualizada em 17/10/2024 14h48</small></p>
                        <a class="" href="https://ge.globo.com/motor/formula-1/noticia/2024/10/17/f1-deixara-de-dar-ponto-extra-para-volta-mais-rapida-em-2025.ghtml" target="_blank"><button type="button" class="btn btn-danger m-3 position-absolute bottom-0 end-0">Veja Aqui!</button></a>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 border-danger col-xs-12 col-sm-10 col-md-10 col-lg-8 col-xl-8" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="img/card/2card.jpg" class="img-fluid rounded-start m-3 rounded-3" alt="..." style="max-width: 100%;">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body ms-3">
                        <h5 class="card-title">Scott Speed Revela que Correu de Fraldas na F1 Devido a Doença</h5>
                        <p class="card-text">Scott Speed, que quebrou o jejum de pilotos americanos na F1 em 2006, revelou ter pilotado de fraldas por conta de colite ulcerativa. Diagnosticado anos antes, ele superou o desafio com concentração e apoio da equipe.</p>
                        <p class="card-text"><small class="text-body-secondary">Notícia atualizada em 17/10/2024 10h20</small></p>
                        <a class="" href="https://ge.globo.com/motor/formula-1/noticia/2024/10/17/piloto-que-encerrou-jejum-de-americanos-na-f1-correu-de-fraldas-por-doenca.ghtml" target="_blank"><button type="button" class="btn btn-danger m-3 position-absolute bottom-0 end-0">Veja Aqui!</button></a>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 border-danger col-xs-12 col-sm-10 col-md-10 col-lg-8 col-xl-8" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="img/card/3card.jpg" class="img-fluid rounded-start m-3 rounded-3" alt="..." style="max-width: 100%;">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body ms-3">
                        <h5 class="card-title">Red Bull Confirma Dispositivo Polêmico e Aceita Ajustes com a FIA</h5>
                        <p class="card-text">A Red Bull admitiu um dispositivo em seu carro que pode alterar a suspensão dianteira, mas negou uso fora das regras. A FIA segue vigilante e propôs selar o componente para garantir conformidade futura.</p>
                        <p class="card-text"><small class="text-body-secondary">Notícia atualizada em 18/10/2024 10h43</small></p>
                        <a class="" href="https://ge.globo.com/motor/formula-1/noticia/2024/10/18/rbr-admite-dispositivo-polemico-nega-uso-indevido-mas-mudara-carro.ghtml" target="_blank"><button type="button" class="btn btn-danger m-3 position-absolute bottom-0 end-0">Veja Aqui!</button></a>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 border-danger col-xs-12 col-sm-10 col-md-10 col-lg-8 col-xl-8" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="img/card/4card.jpg" class="img-fluid rounded-start m-3 rounded-3" alt="..." style="max-width: 100%;">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body ms-3">
                        <h5 class="card-title">Ralf Schumacher: "Nem Hamilton Superará Michael"</h5>
                        <p class="card-text">Ralf Schumacher afirmou que nem Lewis Hamilton conseguirá igualar as conquistas de seu irmão, Michael Schumacher, destacando o talento único e a sorte de Michael em estar na Ferrari no momento certo. Ele também elogiou Max Verstappen, comparando seu talento ao de Hamilton.</p>
                        <p class="card-text"><small class="text-body-secondary">Notícia atualizada em 16/10/2024 19h08</small></p>
                        <a class="" href="https://ge.globo.com/motor/formula-1/noticia/2024/10/16/ralf-schumacher-diz-que-nem-hamilton-chegara-nas-conquistas-do-irmao-michael.ghtml" target="_blank"><button type="button" class="btn btn-danger m-3 position-absolute bottom-0 end-0">Veja Aqui!</button></a>
                    </div>
                    </div>
                </div>
            </div>

            <a class="row justify-content-center text-decoration-none" href="https://ge.globo.com/motor/formula-1/" target="_blank"><button type="button" class="btn btn-danger col-xs-6 col-sm-4 col-md-4 col-lg-2 col-xl-2">Ver Mais!</button></a>

        </div>
    </div>

<?php include "comp/footer.php" ?>