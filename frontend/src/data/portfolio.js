export const profile = {
  full_name: 'Maulana Husein',
  nickname: 'Maulana',
  headline: 'Enthusiastic Full-Stack Web Developer',
  bio: 'Saya Maulana Husein, seorang programmer yang antusias membangun aplikasi web end-to-end. Fokus utama saya adalah full-stack web development, dari merawat sistem legacy sampai mengembangkan produk yang scalable dan terintegrasi dengan berbagai platform.',
  birth_place: 'Bandung',
  birth_date: '2005-10-08',
  location: 'Bandung, Jawa Barat',
  focus: 'Full-Stack Web Development',
  email: 'maulanahusain@proton.me',
  phone: '08976321037',
  photo_url: null,
  cv_url: null,
  socials: [
    { id: 'email', label: 'Email', url: 'mailto:maulanahusain@proton.me' },
    { id: 'whatsapp', label: 'WhatsApp', url: 'https://wa.me/628976321037' },
  ],
}

export const skillCategories = [
  {
    id: 'languages',
    name: 'Bahasa Pemrograman',
    skills: [
      { id: 'php', name: 'PHP' },
      { id: 'javascript', name: 'JavaScript' },
      { id: 'python', name: 'Python' },
      { id: 'sql', name: 'SQL' },
    ],
  },
  {
    id: 'backend',
    name: 'Backend & Framework',
    skills: [
      { id: 'laravel', name: 'Laravel' },
      { id: 'codeigniter', name: 'CodeIgniter 2 & 3' },
      { id: 'fastapi', name: 'FastAPI' },
    ],
  },
  {
    id: 'frontend',
    name: 'Frontend',
    skills: [
      { id: 'vue', name: 'Vue.js' },
      { id: 'html', name: 'HTML' },
      { id: 'css', name: 'CSS' },
    ],
  },
  {
    id: 'databases',
    name: 'Database',
    skills: [
      { id: 'mysql', name: 'MySQL' },
      { id: 'postgresql', name: 'PostgreSQL' },
      { id: 'mongodb', name: 'MongoDB (NoSQL)' },
    ],
  },
  {
    id: 'integration',
    name: 'Integrasi & API',
    skills: [
      { id: 'rest-api', name: 'REST API' },
      { id: 'odoo', name: 'Odoo' },
      { id: 'meta', name: 'Meta Platform APIs' },
      { id: 'swagger', name: 'Swagger / OpenAPI' },
    ],
  },
  {
    id: 'tools',
    name: 'Development Tools',
    skills: [
      { id: 'vscode', name: 'VS Code' },
      { id: 'postman', name: 'Postman' },
      { id: 'git', name: 'Git' },
      { id: 'github', name: 'GitHub' },
    ],
  },
]

export const experiences = [
  {
    id: 'omnichannel',
    title: 'Omnichannel Platform',
    subtitle: 'FastAPI · Vue.js · Multi-channel Integration',
    points: [
      'Sedang membangun platform omnichannel yang scalable dengan FastAPI dan Vue.js.',
      'Mengintegrasikan Instagram, WhatsApp, Messenger, dan Gmail dalam satu alur komunikasi.',
      'Merancang fondasi aplikasi agar mudah dikembangkan seiring bertambahnya channel dan kebutuhan bisnis.',
    ],
  },
  {
    id: 'project-management',
    title: 'Project Management Website',
    subtitle: 'Main Developer · Laravel · Odoo Integration',
    points: [
      'Menjadi main developer untuk website project management berbasis Laravel.',
      'Menangani pengembangan aplikasi sekaligus integrasi dua arah dengan Odoo.',
      'Mengelola kebutuhan teknis dari sisi aplikasi web dan sistem ERP.',
    ],
  },
  {
    id: 'hris',
    title: 'Internal HRIS',
    subtitle: 'Maintainer & Feature Developer · Laravel',
    points: [
      'Memelihara aplikasi HRIS internal perusahaan berbasis Laravel.',
      'Mengembangkan beberapa fitur baru sesuai kebutuhan operasional internal.',
      'Menjaga aplikasi tetap stabil sambil melanjutkan pengembangan fungsionalitasnya.',
    ],
  },
  {
    id: 'institution-apps',
    title: 'Operational Applications',
    subtitle: 'Application Maintainer · CodeIgniter 3',
    points: [
      'Memelihara beberapa aplikasi instansi berbasis CodeIgniter 3 secara bersamaan.',
      'Menangani aplikasi seperti inventory management dan purchase order management.',
      'Melakukan perbaikan serta penyesuaian aplikasi untuk kebutuhan operasional.',
    ],
  },
  {
    id: 'legacy',
    title: 'Legacy Web Application',
    subtitle: 'Maintainer · CodeIgniter 2 · MySQL',
    points: [
      'Merawat dan mengembangkan web legacy berbasis CodeIgniter 2 dan MySQL.',
      'Menangani kebutuhan perbaikan serta keberlanjutan aplikasi yang sudah berjalan.',
    ],
  },
  {
    id: 'landing-page',
    title: 'Dynamic Landing Page',
    subtitle: 'Full-Stack Development · Admin Panel',
    points: [
      'Membangun landing page dinamis yang seluruh kontennya dapat diatur dari backend/admin panel.',
      'Menyediakan fleksibilitas pengelolaan konten tanpa perlu mengubah kode di sisi frontend.',
    ],
  },
]

export const educations = [
  {
    id: 'smk-marhas',
    level: 'Sekolah Menengah Kejuruan',
    institution: 'SMK Marhas',
    year_start: 2021,
    year_end: 2024,
  },
  {
    id: 'mts-alhaq',
    level: 'Madrasah Tsanawiyah',
    institution: 'MTs Alhaq',
    year_start: 2018,
    year_end: 2021,
  },
]
