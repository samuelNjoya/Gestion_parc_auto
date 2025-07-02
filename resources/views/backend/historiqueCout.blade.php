@extends('backend.layouts.app')
@section('content')

   <div class="container">
      <h2 style="text-align:center;">Coût total carburant par mois (année {{ $annee }})</h2>

    <!-- Filtre année -->
    {{-- <form method="GET" action="{{ url('panel/historique_cout') }}" style="text-align:center; margin-bottom: 20px;">
       <div class="row">
        <div class="form-group col-md-2">
        <label for="annee">Choisir une année : </label>
        <select name="annee" id="annee" onchange="this.form.submit()">
            @foreach($anneesDisponibles as $a)
                <option value="{{ $a }}" {{ $a == $annee ? 'selected' : '' }}>{{ $a }}</option>
            @endforeach
        </select>
       </div>
      
       </div>
    </form> --}}
    @if($vehiculeId)
      <h4 style="text-align:center;">Véhicule : {{ $vehicules->firstWhere('id', $vehiculeId)->immatriculation }}</h4>
    @endif


    <form method="GET" action="{{ url('panel/historique_cout') }}" style="text-align:center; margin-bottom: 20px;">
        <div class="row">
             <div class="form-group col-md-2">
                 <label for="annee">Choisir une année :</label>
                 <select name="annee" id="annee" onchange="this.form.submit()">
                     @foreach($anneesDisponibles as $a)
                         <option value="{{ $a }}" {{ $a == $annee ? 'selected' : '' }}>{{ $a }}</option>
                     @endforeach
                 </select>
             </div>
     
             <div class="form-group col-md-3">
                 <label for="vehicule_id">Choisir un véhicule :</label>
                 <select name="vehicule_id" id="vehicule_id" onchange="this.form.submit()">
                     <option value="">-- Tous les véhicules --</option>
                     @foreach($vehicules as $vehicule)
                         <option value="{{ $vehicule->id }}" {{ $vehiculeId == $vehicule->id ? 'selected' : '' }}>
                             {{ $vehicule->immatriculation }}-{{ $vehicule->marque }}
                         </option>
                     @endforeach
                     {{-- @foreach ($getVehicule as $item)
                             <option value="{{$item->id}}">{{$item->marque}}-{{$item->immatriculation}}</option>
                    @endforeach --}}
                 </select>
             </div>
        </div>
     </form>
     
      
    <div class="col-md-2 my-3 flex-end" style="position: absolute; top:120px; right:90px;">
          <button class="btn btn-primary pull-right" onclick="exportPDF()"> Exporter en PDF</button>
    </div>
       

   </div>

   <div class="card">
       <div class="container">
        <h3>Coût carburant (par mois)</h3>
       <div style="width: 80%; margin: auto;">
        <canvas id="carburantChart"></canvas>
    </div>
   </div>
   </div>

@endsection

@section('scripts')

<script>
        const ctx = document.getElementById('carburantChart').getContext('2d');
        const carburantChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Coût total (par mois)',
                    data: {!! json_encode($values) !!},
                    backgroundColor: '#1E3A8A',
                    borderColor: '#DC2626',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Coût (FCFA)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Mois'
                        }
                    }
                }
            }
        });

       //pour telecharger en pdf
    // async function exportPDF() {
    //     const canvas = document.getElementById('carburantChart');
    //     const canvasImage = await html2canvas(canvas, { scale: 2 });
    //     const imageData = canvasImage.toDataURL('image/png');

    //     const { jsPDF } = window.jspdf;
    //     const pdf = new jsPDF();

    //     // Calcul dimensions pour le PDF
    //     const pdfWidth = pdf.internal.pageSize.getWidth();
    //     const pdfHeight = (canvas.height / canvas.width) * pdfWidth;

    //     pdf.addImage(imageData, 'PNG', 0, 10, pdfWidth, pdfHeight);
    //     pdf.save("cout_carburant_{{ $annee }}.pdf");
    // }

   async function exportPDF() {
    const canvas = document.getElementById('carburantChart');
    const canvasImage = await html2canvas(canvas, { scale: 2 });

    // CORRECTION : utiliser "image/jpeg" (et pas juste "JPEG")
    const imageData = canvasImage.toDataURL('image/jpeg');

    const logoImg = new Image();

    // CORRECTION : s'assurer que le chemin du logo est bon
    logoImg.src = "{{ asset('images/logoCelson.jpeg') }}";

    logoImg.onload = function () {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        const pdfWidth = pdf.internal.pageSize.getWidth();
        const chartHeight = (canvas.height / canvas.width) * pdfWidth;
        let yOffset = 20;

        // Logo deux dernières valeurs taille du logo dans le pdf
        pdf.addImage(logoImg, 'JPEG', 10, 10, 45, 35);

        // Titre
        pdf.setFontSize(16);
       // pdf.text("Rapport Mensuel - Coût du Carburant ({{ $annee }})", pdfWidth / 2, 20, { align: 'center' });
       pdf.text("Rapport Mensuel - Coût du Carburant ({{ $annee }} @if($vehiculeNom) - {{ $vehiculeNom }} @endif)", pdfWidth / 2, 20, { align: 'center' });


        yOffset += 20;

        // Graphique
        pdf.addImage(imageData, 'JPEG', 10, yOffset, pdfWidth - 20, chartHeight);

        // Pied de page
        const today = new Date().toLocaleDateString();
        pdf.setFontSize(10);
        pdf.text("Généré le " + today + " - CELSON Industries", pdfWidth / 2, 285, { align: 'center' });

        // Enregistre le PDF
        pdf.save("rapport_carburant_{{ $annee }}.pdf");
    };
}

    </script>

@endsection