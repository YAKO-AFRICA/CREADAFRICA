import { getPropositions, getDashbordData } from './reduce.js';

function formatMoney(value){
    return Number(value ?? 0).toLocaleString('fr-FR') + ' FCFA';
}

document.addEventListener('DOMContentLoaded', async function() {

    /* =========================
       CACHE DOM
    ==========================*/
    const el = {
        primeCumule: document.getElementById('primeCumule'),
        percent: document.getElementById('objectifPercent'),
        bar: document.getElementById('objectifBar'),
        text: document.getElementById('objectifText'),
        countSaisie: document.getElementById('countSaisie'),
        coutSaisieWeek: document.getElementById('coutSaisieWeek'),
        countTransmis: document.getElementById('countContratTransmis'),
        countTransmisActif: document.getElementById('countContratTransmisActifYear'),
        countAccepte: document.getElementById('countContratAccepteYear'),
        tauxAccept: document.getElementById('tauxAcceptPercent'),
        countRejet: document.getElementById('countRejetesYear'),
        tauxRejet: document.getElementById('tauxRejetPercent'),
        btnWeek: document.getElementById('btnWeek'),
        btnMonth: document.getElementById('btnMonth'),
        objectif: document.getElementById('objectif')
    };

    /* =========================
       CHART INIT (une seule fois)
    ==========================*/
    const ctx = document.getElementById('chartActivite');
    const chartActivite = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Transmis',
                    data: [],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,.05)',
                    tension: .4,
                    fill: true
                },
                {
                    label: 'Acceptées',
                    data: [],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,.05)',
                    tension: .4,
                    fill: true
                }
            ]
        },
        options:{
            responsive:true,
            maintainAspectRatio:false,
            plugins:{legend:{display:false}}
        }
    });

    function updateChart(labels, transmis, acceptes){
        chartActivite.data.labels = labels;
        chartActivite.data.datasets[0].data = transmis;
        chartActivite.data.datasets[1].data = acceptes;
        chartActivite.update();
    }

    /* =========================
       LOAD DASHBOARD PRIORITY
    ==========================*/
    const data = await getDashbordData();
    
    console.log(data.produits);

    /* =========================
       OBJECTIF
    ==========================*/
    const objectif = 1000;
    el.objectif.innerHTML = formatMoney(objectif);

    const montant = Number(data.primeMonthCumule ?? 0);
    const percent = Math.min((montant / objectif) * 100, 100);
    const reste = objectif - montant;

    el.primeCumule.innerHTML = formatMoney(data.primeYearCumule);
    el.percent.innerHTML = percent.toFixed(0) + '%';
    el.bar.style.width = percent + '%';

    el.text.innerHTML =
        `Realisé : ${formatMoney(montant)} · Reste : ${formatMoney(reste>0?reste:0)}`;

    /* =========================
       COUNT
    ==========================*/
    el.countSaisie.innerHTML = data.contratsYear ?? 0;
    el.coutSaisieWeek.innerHTML = data.contratsWeek ?? 0;
    el.countTransmis.innerHTML = data.transmisYear ?? 0;
    el.countTransmisActif.innerHTML = data.transmisActifYear ?? 0;
    el.countAccepte.innerHTML = data.accepteYear ?? 0;
    el.tauxAccept.innerHTML = data.tauxAcceptPercent ?? 0;
    el.countRejet.innerHTML = data.rejetesYear ?? 0;
    el.tauxRejet.innerHTML = data.tauxRejetPercent ?? 0;

    /* =========================
       CHART DEFAULT WEEK
    ==========================*/
    updateChart(
        data.chart.week.labels,
        data.chart.week.transmis,
        data.chart.week.acceptes
    );

    el.btnWeek.onclick = () => {
        updateChart(
            data.chart.week.labels,
            data.chart.week.transmis,
            data.chart.week.acceptes
        );
    };

    el.btnMonth.onclick = () => {
        updateChart(
            data.chart.month.labels,
            data.chart.month.transmis,
            data.chart.month.acceptes
        );
    };

    let donutChart = null;

    function initDonutChart(produits){
        const colors = ['#3b82f6','#8b5cf6','#10b981','#f59e0b','#ef4444','#ec4899'];

        const labels = produits.map(p => p.libelleproduit);
        const dataProduits = produits.map(p => Number(p.total));
        const primeProduits = produits.map(p => Number(p.primeCumule ?? 0));

        if(donutChart){
            donutChart.destroy();
        }

        donutChart = new Chart(document.getElementById('chartDonut'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataProduits,
                    backgroundColor: colors,
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: { legend: { display: false } }
            }
        });

        // legend avec cumul des primes
        const lg = document.getElementById('donutLegend');
        lg.innerHTML = '';

        labels.forEach((label,i)=>{
            lg.innerHTML += `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:10px;height:10px;background:${colors[i]};border-radius:50%"></div>
                        <span class="small">${label}</span>
                    </div>
                    <span class="small fw-semibold">${Number(primeProduits[i]).toLocaleString('fr-FR')} FCFA</span>
                </div>
            `;
        });
    }

    // default year
    initDonutChart(data.produits.year);

    const btns = document.querySelectorAll('.btnProd');
    const label = document.getElementById('prodTimeLabel');

    btns.forEach(btn=>{
        btn.addEventListener('click', ()=>{
            btns.forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');

            if(btn.id === 'btnProdYear'){
                label.textContent = "Année en cours";
                initDonutChart(data.produits.year);
            } else {
                label.textContent = "Mois en cours";
                initDonutChart(data.produits.month);
            }
        });
    });


    /* =========================
       LOAD TABLE ASYNC (non bloquant)
    ==========================*/
    setTimeout(async () => {

        const resultBody = document.getElementById('result');
        if (!resultBody) return;

        const communeList = await getPropositions();

        resultBody.innerHTML = communeList.length
            ? communeList.map(item => `
                <tr>
                    <td>${item.IdTblBranche}</td>
                    <td>${item.CodeBranche}</td>
                    <td>${item.MonLibelle}</td>
                    <td>${item.ID_Old}</td>
                </tr>
            `).join('')
            : `<tr>
                 <td colspan="4" class="text-danger text-center">
                    Aucune donnée valide reçue
                 </td>
               </tr>`;

    }, 50); // charge après dashboard

});


