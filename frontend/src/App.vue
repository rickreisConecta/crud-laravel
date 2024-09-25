<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'

const currentYear = new Date().getFullYear()
</script>

<template>
  <header>
    <div class="wrapper">
      <nav class="navbar bg-dark navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
          <RouterLink class="navbar-brand mx-auto" to="/"
            >Book Register</RouterLink
          >

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div
            class="collapse navbar-collapse justify-content-center"
            id="navbarSupportedContent"
          >
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <RouterLink class="nav-link" aria-current="page" to="/"
                  >Home</RouterLink
                >
              </li>

              <li class="nav-item">
                <RouterLink class="nav-link" to="/sobre">Sobre</RouterLink>
              </li>

              <li class="nav-item">
                <RouterLink class="nav-link" to="/livros">Livros</RouterLink>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <RouterView />

  <footer
    class="text-center d-flex w-100 align-items-center justify-content-between mt-5 px-5 py-2 bg-success text-white"
  >
    <h5 class="m-0">
      {{ currentYear }}
      BookRegister
    </h5>

    <h5 class="m-0">2024</h5>
  </footer>
</template>
