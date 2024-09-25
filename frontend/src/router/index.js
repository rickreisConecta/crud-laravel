import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SobreView from '../views/SobreView.vue'
import LivrosView from '../views/Livros/View.vue'
import LivrosCriar from '../views/Livros/Criar.vue'
import LivrosEditar from '../views/Livros/Editar.vue'
import AutoresCriar from '../views/Autores/Create.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/sobre',
      name: 'sobre',
      component: SobreView
    },
    {
      path: '/livros',
      name: 'Livros',
      component: LivrosView
    },
    {
      path: '/livros/criar',
      name: 'LivrosCriar',
      component: LivrosCriar
    },
    {
      path: '/livros/:id/editar',
      name: 'LivrosEditar',
      component: LivrosEditar
    },
    {
      path: '/autores/criar',
      name: 'AutoresCriar',
      component: AutoresCriar
    },
  ]
})

export default router
