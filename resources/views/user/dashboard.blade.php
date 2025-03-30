<x-user-profile-layout>
  <x-slot:title>Dashboard - {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</x-slot:title>

  <div class="container mx-auto px-4 py-8 dark:bg-gray-900 dark:text-gray-100" x-data="charts()" x-init="init()">
      <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
          <!-- Stat Card 1 -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
              <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Applications</h3>
              <p class="text-2xl font-bold">245</p>
              <div class="text-green-500 text-sm">↑ 12% from last month</div>
          </div>
          
          <!-- Stat Card 2 -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
              <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Active Jobs</h3>
              <p class="text-2xl font-bold">18</p>
              <div class="text-red-500 text-sm">↓ 3% from last month</div>
          </div>
          
          <!-- Stat Card 3 -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
              <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Interviews Scheduled</h3>
              <p class="text-2xl font-bold">32</p>
              <div class="text-green-500 text-sm">↑ 8% from last month</div>
          </div>
          
          <!-- Stat Card 4 -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
              <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Profile Views</h3>
              <p class="text-2xl font-bold">1,245</p>
              <div class="text-green-500 text-sm">↑ 24% from last month</div>
          </div>
      </div>

      <!-- Charts Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Chart 1: Applications Over Time -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
              <h3 class="text-lg font-semibold mb-4">Applications Timeline</h3>
              <canvas id="applicationsChart"></canvas>
          </div>
          
          <!-- Chart 2: Job Categories -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
              <h3 class="text-lg font-semibold mb-4">Job Categories Distribution</h3>
              <canvas id="jobCategoriesChart"></canvas>
          </div>
      </div>

      <!-- Recent Activity -->
      <div class="mt-8">
          <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
              <div class="divide-y divide-gray-200 dark:divide-gray-700">
                  <div class="p-4">
                      <p class="text-sm">New application received for <span class="font-medium">Senior Developer</span></p>
                      <p class="text-xs text-gray-500 dark:text-gray-400">2 hours ago</p>
                  </div>
                  <div class="p-4">
                      <p class="text-sm">Interview scheduled with <span class="font-medium">John Doe</span></p>
                      <p class="text-xs text-gray-500 dark:text-gray-400">5 hours ago</p>
                  </div>
                  <div class="p-4">
                      <p class="text-sm">New job posting: <span class="font-medium">UI/UX Designer</span></p>
                      <p class="text-xs text-gray-500 dark:text-gray-400">1 day ago</p>
                  </div>
              </div>
          </div>
      </div>

      <!-- Chart.js and AlpineJS integration -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
          function charts() {
              return {
                  init() {
                      // Applications Timeline Chart (Line Chart)
                      const appCtx = document.getElementById('applicationsChart').getContext('2d');
                      new Chart(appCtx, {
                          type: 'line',
                          data: {
                              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                              datasets: [{
                                  label: 'Applications',
                                  data: [30, 45, 28, 60, 75, 50, 90],
                                  backgroundColor: 'rgba(66, 153, 225, 0.2)',
                                  borderColor: 'rgba(66, 153, 225, 1)',
                                  borderWidth: 2,
                                  fill: true,
                                  tension: 0.4
                              }]
                          },
                          options: {
                              responsive: true,
                              plugins: {
                                  legend: {
                                      labels: {
                                          color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151'
                                      }
                                  }
                              },
                              scales: {
                                  x: {
                                      ticks: {
                                          color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151'
                                      }
                                  },
                                  y: {
                                      ticks: {
                                          color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151'
                                      }
                                  }
                              }
                          }
                      });

                      // Job Categories Distribution Chart (Pie Chart)
                      const jobCtx = document.getElementById('jobCategoriesChart').getContext('2d');
                      new Chart(jobCtx, {
                          type: 'pie',
                          data: {
                              labels: ['Development', 'Design', 'Marketing', 'Sales'],
                              datasets: [{
                                  data: [40, 20, 25, 15],
                                  backgroundColor: [
                                      '#4299e1',
                                      '#48bb78',
                                      '#ecc94b',
                                      '#f56565'
                                  ],
                                  hoverOffset: 4
                              }]
                          },
                          options: {
                              responsive: true,
                              plugins: {
                                  legend: {
                                      labels: {
                                          color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151'
                                      }
                                  }
                              }
                          }
                      });
                  }
              }
          }
      </script>
  </div>
</x-user-profile-layout>
