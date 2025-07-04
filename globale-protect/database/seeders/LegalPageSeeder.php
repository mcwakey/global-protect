<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LegalPage;

class LegalPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $legalPages = [
            [
                'type' => 'privacy',
                'title' => [
                    'en' => 'Privacy Policy',
                    'fr' => 'Politique de Confidentialité'
                ],
                'content' => [
                    'en' => "Privacy Policy

Effective Date: " . date('F d, Y') . "

1. Information We Collect
We collect information you provide directly to us, such as when you create an account, contact us, or use our emergency services platform.

2. How We Use Your Information
We use the information we collect to:
- Provide, maintain, and improve our emergency response services
- Process and complete transactions
- Send you technical notices and support messages
- Respond to your comments and questions

3. Information Sharing
We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.

4. Data Security
We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.

5. Your Rights
You have the right to access, update, or delete your personal information. You may also opt out of certain communications from us.

6. Contact Us
If you have any questions about this Privacy Policy, please contact us at privacy@globaleprotect.com.",
                    'fr' => "Politique de Confidentialité

Date d'entrée en vigueur : " . date('d F Y') . "

1. Informations que nous collectons
Nous collectons les informations que vous nous fournissez directement, par exemple lorsque vous créez un compte, nous contactez ou utilisez notre plateforme de services d'urgence.

2. Comment nous utilisons vos informations
Nous utilisons les informations que nous collectons pour :
- Fournir, maintenir et améliorer nos services de réponse d'urgence
- Traiter et compléter les transactions
- Vous envoyer des notifications techniques et des messages de support
- Répondre à vos commentaires et questions

3. Partage d'informations
Nous ne vendons, n'échangeons ni ne transférons vos informations personnelles à des tiers sans votre consentement, sauf comme décrit dans cette politique.

4. Sécurité des données
Nous mettons en place des mesures de sécurité appropriées pour protéger vos informations personnelles contre l'accès non autorisé, l'altération, la divulgation ou la destruction.

5. Vos droits
Vous avez le droit d'accéder, de mettre à jour ou de supprimer vos informations personnelles. Vous pouvez également vous désabonner de certaines communications de notre part.

6. Nous contacter
Si vous avez des questions concernant cette Politique de Confidentialité, veuillez nous contacter à privacy@globaleprotect.com."
                ],
                'is_active' => true
            ],
            [
                'type' => 'terms',
                'title' => [
                    'en' => 'Terms of Use',
                    'fr' => 'Conditions d\'Utilisation'
                ],
                'content' => [
                    'en' => "Terms of Use

Last Updated: " . date('F d, Y') . "

1. Acceptance of Terms
By accessing and using Globale Protect's emergency services platform, you accept and agree to be bound by these Terms of Use.

2. Description of Service
Globale Protect provides digital solutions for emergency and rescue services, including communication platforms, dispatch systems, and emergency response tools.

3. User Responsibilities
You agree to:
- Use the service only for lawful purposes
- Provide accurate and complete information
- Maintain the security of your account credentials
- Report any unauthorized use of your account

4. Service Availability
We strive to maintain service availability but cannot guarantee uninterrupted access. Emergency services should always have backup communication methods.

5. Intellectual Property
All content, features, and functionality of our platform are owned by Globale Protect and are protected by intellectual property laws.

6. Limitation of Liability
Globale Protect shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of the service.

7. Modifications
We reserve the right to modify these terms at any time. Continued use of the service constitutes acceptance of the modified terms.

8. Contact Information
For questions about these Terms of Use, contact us at legal@globaleprotect.com.",
                    'fr' => "Conditions d'Utilisation

Dernière mise à jour : " . date('d F Y') . "

1. Acceptation des conditions
En accédant et en utilisant la plateforme de services d'urgence de Globale Protect, vous acceptez et vous engagez à être lié par ces Conditions d'Utilisation.

2. Description du service
Globale Protect fournit des solutions numériques pour les services d'urgence et de secours, y compris des plateformes de communication, des systèmes de répartition et des outils de réponse d'urgence.

3. Responsabilités de l'utilisateur
Vous vous engagez à :
- Utiliser le service uniquement à des fins légales
- Fournir des informations exactes et complètes
- Maintenir la sécurité de vos identifiants de compte
- Signaler toute utilisation non autorisée de votre compte

4. Disponibilité du service
Nous nous efforçons de maintenir la disponibilité du service mais ne pouvons garantir un accès ininterrompu. Les services d'urgence doivent toujours avoir des méthodes de communication de secours.

5. Propriété intellectuelle
Tout le contenu, les fonctionnalités et les fonctions de notre plateforme appartiennent à Globale Protect et sont protégés par les lois sur la propriété intellectuelle.

6. Limitation de responsabilité
Globale Protect ne sera pas responsable des dommages indirects, accessoires, spéciaux, consécutifs ou punitifs résultant de votre utilisation du service.

7. Modifications
Nous nous réservons le droit de modifier ces conditions à tout moment. L'utilisation continue du service constitue l'acceptation des conditions modifiées.

8. Informations de contact
Pour des questions concernant ces Conditions d'Utilisation, contactez-nous à legal@globaleprotect.com."
                ],
                'is_active' => true
            ],
            [
                'type' => 'cookies',
                'title' => [
                    'en' => 'Cookie Policy',
                    'fr' => 'Politique des Cookies'
                ],
                'content' => [
                    'en' => "Cookie Policy

Last Updated: " . date('F d, Y') . "

1. What Are Cookies
Cookies are small text files that are placed on your device when you visit our website. They help us provide you with a better user experience.

2. Types of Cookies We Use

Essential Cookies:
- Required for the website to function properly
- Enable you to navigate and use basic features
- Cannot be disabled without affecting site functionality

Performance Cookies:
- Help us understand how visitors interact with our website
- Provide information about areas visited and time spent
- Allow us to improve website performance

Functional Cookies:
- Remember your preferences and settings
- Provide enhanced features and personalization
- Enable language selection and theme preferences

3. Third-Party Cookies
We may use third-party services that place cookies on your device. These services have their own privacy policies.

4. Managing Cookies
You can control cookies through your browser settings:
- View cookies stored on your device
- Delete existing cookies
- Block future cookies (may affect site functionality)

5. Cookie Consent
By using our website, you consent to our use of cookies as described in this policy.

6. Updates to This Policy
We may update this Cookie Policy periodically. Check this page for the latest version.

7. Contact Us
For questions about our use of cookies, contact us at privacy@globaleprotect.com.",
                    'fr' => "Politique des Cookies

Dernière mise à jour : " . date('d F Y') . "

1. Que sont les cookies
Les cookies sont de petits fichiers texte placés sur votre appareil lorsque vous visitez notre site web. Ils nous aident à vous offrir une meilleure expérience utilisateur.

2. Types de cookies que nous utilisons

Cookies essentiels :
- Nécessaires au bon fonctionnement du site web
- Vous permettent de naviguer et d'utiliser les fonctionnalités de base
- Ne peuvent pas être désactivés sans affecter la fonctionnalité du site

Cookies de performance :
- Nous aident à comprendre comment les visiteurs interagissent avec notre site web
- Fournissent des informations sur les zones visitées et le temps passé
- Nous permettent d'améliorer les performances du site web

Cookies fonctionnels :
- Mémorisent vos préférences et paramètres
- Fournissent des fonctionnalités améliorées et de la personnalisation
- Permettent la sélection de langue et les préférences de thème

3. Cookies de tiers
Nous pouvons utiliser des services tiers qui placent des cookies sur votre appareil. Ces services ont leurs propres politiques de confidentialité.

4. Gestion des cookies
Vous pouvez contrôler les cookies via les paramètres de votre navigateur :
- Voir les cookies stockés sur votre appareil
- Supprimer les cookies existants
- Bloquer les futurs cookies (peut affecter la fonctionnalité du site)

5. Consentement aux cookies
En utilisant notre site web, vous consentez à notre utilisation des cookies comme décrit dans cette politique.

6. Mises à jour de cette politique
Nous pouvons mettre à jour cette Politique des Cookies périodiquement. Consultez cette page pour la dernière version.

7. Nous contacter
Pour des questions concernant notre utilisation des cookies, contactez-nous à privacy@globaleprotect.com."
                ],
                'is_active' => true
            ]
        ];

        foreach ($legalPages as $pageData) {
            LegalPage::create($pageData);
        }
    }
}
