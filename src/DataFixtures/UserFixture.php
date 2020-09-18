<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('toto@toto.com');
        $user1->setLastName('tata');
        $user1->setFirstName('toto');
        $user1->setDuckName('Toto');
        $user1->setImg('https://img-31.ccm2.net/aoRGBEGGQk_4JKu7HmX1rD12M58=/1240x/smart/0476616b609244458962620520ffe5e6/ccmcms-hugo/10605741.jpg');
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'toto'
        ));

        $user2 = new User();
        $user2->setEmail('tata@tata.com');
        $user2->setLastName('Mireille');
        $user2->setFirstName('tata');
        $user2->setDuckName('Tata');
        $user2->setImg('https://img-31.ccm2.net/aoRGBEGGQk_4JKu7HmX1rD12M58=/1240x/smart/0476616b609244458962620520ffe5e6/ccmcms-hugo/10605741.jpghttps://storenotrefamilleprod.blob.core.windows.net/images/cms/article/337864/337864_large.jpg');
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            'toto'
        ));
        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}