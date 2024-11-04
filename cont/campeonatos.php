<?php include "../config.php"; ?>
<?php include "../comp/header.php"; ?>

        <div class="container-fluid"  data-aos="fade-up" data-aos-delay="50" data-aos-duration="500">
			<div class="justify-content-start">
				<div class="bg2 p-5 rounded-5 border-bottom border-danger border-3">
					<div class="row mt-5">
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-6 col-xl-6 p-5">
							<div class="p-4"></div>
							<h1 class="card-title display-6 text-start text-danger fw-bold pb-5">Resultados dos Campeonatos</h1>
							<p class="card-text text-start fw-bold text-light pb-5">Veja todos os campeões de cada Grande Prêmio da Fórmula 1 desde sua criação em 1950 até os dias atuais!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- Seleção de ano -->
        <div class="container-fluid" style="margin-top: 100px; margin-bottom: 100px;" data-aos="fade-up" data-aos-delay="50" data-aos-duration="500">
            <div class="row justify-content-center ">
                <select id="year-select" class="border-danger text-center form-select w-50 text-danger" style="background-color: rgba(0, 0, 0, 0.5);" aria-label="Select year" onchange="loadTable(this.value)" data-bs-theme="dark">
                    <?php 
                        for ($year = 2024; $year >= 1950; $year--) {
                            echo "<option class='' style='background-color: rgba(0, 0, 0, 0.9);' data-bs-theme='dark' value='$year'>$year</option>";
                        }
                    ?>
                </select>
            </div>
            
                <div id="table-container" class="">
                    <!-- A tabela será carregada aqui via AJAX -->
                </div>
            </div>

<script>
function loadTable(year) {
    // Requisição AJAX para carregar a tabela do ano selecionado
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "load_table.php?year=" + year, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("table-container").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// Carrega a tabela do ano atual ao carregar a página
document.addEventListener("DOMContentLoaded", function() {
    loadTable(2024); // Carregar inicialmente o ano de 2024
});
</script>

<?php include "../comp/footer.php"; ?>



