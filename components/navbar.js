class CustomNavbar extends HTMLElement {
  connectedCallback() {
    this.attachShadow({ mode: 'open' });
    this.shadowRoot.innerHTML = `
      <style>
        .navbar {
          background: linear-gradient(90deg, #1e3a8a, #3b82f6);
          color: white;
          padding: 1rem 2rem;
          box-shadow: 0 4px 6px rgba(0,0,0,0.1);
          position: sticky;
          top: 0;
          z-index: 50;
        }
        .nav-container {
          display: flex;
          justify-content: space-between;
          align-items: center;
          max-width: 1200px;
          margin: 0 auto;
        }
        .logo {
          font-size: 1.5rem;
          font-weight: bold;
        }
        .nav-links {
          display: flex;
          gap: 1.5rem;
        }
        .nav-link {
          color: white;
          text-decoration: none;
          font-weight: 500;
          padding: 0.5rem 0.75rem;
        }
        .nav-link.active {
          color: #facc15;
        }
        .menu-btn {
          display: none;
          background: rgba(255,255,255,0.2);
          border: none;
          padding: 0.5rem 1rem;
          border-radius: 5px;
          color: white;
          cursor: pointer;
        }
        @media (max-width: 768px) {
          .menu-btn { display: block; }
          .nav-links { display: none; }
        }
      </style>

      <nav class="navbar">
        <div class="nav-container">
          <div class="logo">BazarByte StockMaster</div>
          <button class="menu-btn" id="menuBtn">Menu</button>
          <div class="nav-links">
            <a href="index.html" class="nav-link">Tableau de bord</a>
            <a href="products.html" class="nav-link">Produits</a>
            <a href="stock.html" class="nav-link">Stock</a>
            <a href="sales.html" class="nav-link">Ventes</a>
            <a href="reports.html" class="nav-link">Rapports</a>
          </div>
        </div>
      </nav>
    `;

    // ✅ Créer le menu mobile dans le body (hors shadow)
    const dropdown = document.createElement("div");
    dropdown.id = "mobileMenu";
    dropdown.style.cssText = `
      display:none;
      position:fixed;
      top:60px;
      left:0;
      width:100%;
      background:#1e3a8a;
      color:white;
      flex-direction:column;
      z-index:999;
    `;
    dropdown.innerHTML = `
      <a href="index.html" style="padding:1rem;">Tableau de bord</a>
      <a href="products.html" style="padding:1rem;">Produits</a>
      <a href="stock.html" style="padding:1rem;">Stock</a>
      <a href="sales.html" style="padding:1rem;">Ventes</a>
      <a href="reports.html" style="padding:1rem;">Rapports</a>
    `;
    document.body.appendChild(dropdown);

    // ✅ Toggle menu mobile
    const menuBtn = this.shadowRoot.getElementById("menuBtn");
    menuBtn.addEventListener("click", () => {
      dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
    });

    // ✅ Fermeture auto quand on clique sur un lien
    dropdown.querySelectorAll("a").forEach(link => {
      link.addEventListener("click", () => {
        dropdown.style.display = "none";
      });
    });
  }
}
customElements.define('custom-navbar', CustomNavbar);