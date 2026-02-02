// Infografis Module - Chart and toggle functionality

export function initInfografis() {
  // Toggle chart visibility
  window.toggleChart = function (headerElement, containerId) {
    const container = document.getElementById(containerId);
    const btn = headerElement.querySelector('.chart-toggle-btn i');

    if (container.classList.contains('hidden')) {
      container.classList.remove('hidden');
      btn.classList.remove('fa-chevron-right');
      btn.classList.add('fa-chevron-down');
    } else {
      container.classList.add('hidden');
      btn.classList.remove('fa-chevron-down');
      btn.classList.add('fa-chevron-right');
    }
  };

  // Initialize charts
  initCharts();
}

function initCharts() {
  // Chart.js configuration
  if (!window.Chart || !window.infografisData) return;

  Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
  Chart.defaults.color = '#64748b';

  const commonAnimation = {
    duration: 2000,
    easing: 'easeOutQuart'
  };

  const data = window.infografisData;

  // 1. Age Chart
  const ageChartElement = document.getElementById('ageChart');
  if (ageChartElement && data.ageChart) {
    const ctxAge = ageChartElement.getContext('2d');
    new Chart(ctxAge, {
      type: 'bar',
      data: {
        labels: data.ageChart.labels,
        datasets: [{
          label: 'Laki-laki',
          data: data.ageChart.male,
          backgroundColor: '#3b82f6',
          borderRadius: 6,
          barPercentage: 0.7
        }, {
          label: 'Perempuan',
          data: data.ageChart.female,
          backgroundColor: '#ec4899',
          borderRadius: 6,
          barPercentage: 0.7
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: commonAnimation,
        plugins: {
          legend: {
            position: 'top',
            align: 'end',
            labels: { usePointStyle: true, pointStyle: 'circle' }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { borderDash: [5, 5], color: '#f1f5f9' },
            border: { display: false }
          },
          x: {
            grid: { display: false },
            border: { display: false }
          }
        }
      }
    });
  }

  // 2. Education Chart
  const educationChartElement = document.getElementById('educationChart');
  if (educationChartElement && data.educationChart) {
    const ctxEdu = educationChartElement.getContext('2d');
    new Chart(ctxEdu, {
      type: 'doughnut',
      data: {
        labels: data.educationChart.labels,
        datasets: [{
          data: data.educationChart.data,
          backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#cbd5e1'],
          borderWidth: 0,
          hoverOffset: 15
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '75%',
        animation: { animateScale: true, animateRotate: true, duration: 2000, easing: 'easeOutQuart' },
        plugins: {
          legend: {
            position: 'bottom',
            labels: { boxWidth: 12, usePointStyle: true, pointStyle: 'circle', padding: 20 }
          }
        }
      }
    });
  }

  // 3. Job Chart
  const jobChartElement = document.getElementById('jobChart');
  if (jobChartElement && data.jobChart) {
    const ctxJob = jobChartElement.getContext('2d');
    new Chart(ctxJob, {
      type: 'bar',
      data: {
        labels: data.jobChart.labels,
        datasets: [{
          label: 'Jumlah Orang',
          data: data.jobChart.data,
          backgroundColor: '#f59e0b',
          borderRadius: 6,
          barThickness: 24
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        animation: commonAnimation,
        plugins: { legend: { display: false } },
        scales: {
          x: {
            beginAtZero: true,
            grid: { borderDash: [5, 5], color: '#f1f5f9' },
            border: { display: false }
          },
          y: {
            grid: { display: false },
            border: { display: false }
          }
        }
      }
    });
  }

  // 4. Religion Chart
  const religionChartElement = document.getElementById('religionChart');
  if (religionChartElement && data.religionChart) {
    const ctxRel = religionChartElement.getContext('2d');
    new Chart(ctxRel, {
      type: 'pie',
      data: {
        labels: data.religionChart.labels,
        datasets: [{
          data: data.religionChart.data,
          backgroundColor: ['#10b981', '#3b82f6', '#f43f5e', '#f97316', '#eab308'],
          borderWidth: 0,
          hoverOffset: 15
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: { animateScale: true, animateRotate: true, duration: 2000, easing: 'easeOutQuart' },
        plugins: {
          legend: {
            position: 'right',
            labels: { usePointStyle: true, pointStyle: 'circle' }
          }
        }
      }
    });
  }
}
