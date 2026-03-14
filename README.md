# 🚀 WP Deletador

O **WP Deletador** é um plugin leve e eficiente para WordPress projetado para ajudar administradores a realizar a limpeza em massa de postagens antigas com base em critérios específicos de tempo e categoria.

---

## 🛠️ O que o plugin faz?

O plugin adiciona um painel de controle em **Configurações → Apagar Postagens**, permitindo:

* **Filtro por Período:** Apague posts mais antigos que "X" dias e "H" horas.
* **Filtro por Data Fixa:** Apague tudo que foi publicado antes de uma data e hora específica.
* **Seleção de Categoria:** Aplique a regra a todas as categorias ou a uma específica.
* **Modo de Simulação:** Visualize quantas postagens seriam afetadas antes de executar a exclusão.
* **Exclusão Definitiva:** Remove os posts permanentemente (pula a lixeira) para otimizar o banco de dados.

---

## 📂 Estrutura do Projeto

O código é organizado de forma modular para facilitar a manutenção:

* `apagar-postagens-tempo.php`: Arquivo principal e hooks.
* `includes/`: Lógica de cálculos (`apt-cutoff.php`), queries de banco (`apt-query.php`) e constantes.
* `admin/`: Gerenciamento de menus, estilos CSS e lógica da página administrativa.
* `admin/views/`: Templates HTML do formulário.

---

## ⚙️ Instalação

1.  Baixe o repositório ou compacte a pasta do plugin em um arquivo `.zip`.
2.  No seu painel WordPress, vá em **Plugins > Adicionar Novo > Enviar Plugin**.
3.  Selecione o arquivo e clique em **Instalar Agora**.
4.  Ative o plugin **"Apagar Postagens por Tempo"**.
5.  Acesse as configurações em **Configurações > Apagar Postagens**.

---

## ⚠️ Segurança e Recomendações

* **Permissões:** Apenas usuários com capacidade `manage_options` (administradores) podem acessar o painel.
* **Proteção:** O formulário utiliza verificação de `nonce` para evitar ataques CSRF.
* **Backup:** **Sempre realize um backup completo** do seu banco de dados antes de executar a exclusão, pois o processo é irreversível.

---

## 📝 Licença

Distribuído sob a licença MIT. Veja `LICENSE` para mais informações.
