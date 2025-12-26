class CustomFooter extends HTMLElement {
    connectedCallback() {
        this.attachShadow({ mode: 'open' });
        const year = new Date().getFullYear();
        this.shadowRoot.innerHTML = `
            <style>
                footer {
                    background: linear-gradient(90deg, #1e3a8a, #3b82f6);
                    color: white;
                    padding: 2rem 0;
                    margin-top: 2rem;
                }
                .footer-container {
                    max-width: 1200px;
                    margin: 0 auto;
                    padding: 0 2rem;
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 1.5rem;
                }
                .footer-section h4 {
                    font-size: 1rem;
                    font-weight: bold;
                    margin-bottom: 0.75rem;
                }
                .footer-section a {
                    color: #e0f2fe;
                    text-decoration: none;
                    display: block;
                    margin-bottom: 0.5rem;
                    transition: color 0.3s ease;
                }
                .footer-section a:hover {
                    color: #facc15;
                }
                .social-icons {
                    display: flex;
                    gap: 1rem;
                    margin-top: 0.5rem;
                }
                .social-icons i {
                    cursor: pointer;
                    transition: transform 0.3s ease, color 0.3s ease;
                }
                .social-icons i:hover {
                    transform: scale(1.2);
                    color: #facc15;
                }
                .footer-bottom {
                    text-align: center;
                    margin-top: 1.5rem;
                    font-size: 0.875rem;
                    opacity: 0.8;
                }
            </style>
            <footer>
                <div class="footer-container">
                    <div class="footer-section">
                        <h4>BazarByte StockMaster</h4>
                        <p>Votre solution de gestion de stock et ventes.</p>
                    </div>
                    <div class="footer-section">
                        <h4>Liens rapides</h4>
                        <a href="index.html">Tableau de bord</a>
                        <a href="products.html">Produits</a>
                        <a href="stock.html">Stock</a>
                        <a href="sales.html">Ventes</a>
                        <a href="reports.html">Rapports</a>
                    </div>
                    <div class="footer-section">
                        <h4>Contact</h4>
                        <p>Email : farahaneamossou@gmail.com</p>
                        <div class="social-icons">
                            <i data-feather="facebook"></i>
                            <i data-feather="twitter"></i>
                            <i data-feather="linkedin"></i>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    &copy; ${year} BazarByte StockMaster — Version 1.0.0
                </div>
            </footer>
        `;
    }
}
customElements.define('custom-footer', CustomFooter);
