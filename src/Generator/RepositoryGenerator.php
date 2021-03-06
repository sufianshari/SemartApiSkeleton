<?php

declare(strict_types=1);

namespace KejawenLab\ApiSkeleton\Generator;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 */
final class RepositoryGenerator extends AbstractGenerator
{
    public function generate(\ReflectionClass $class, OutputInterface $output): void
    {
        $shortName = $class->getShortName();
        $repository = $this->twig->render('generator/repository.php.twig', ['entity' => $shortName]);
        $repositoryModel = $this->twig->render('generator/repository_model.php.twig', ['entity' => $shortName]);

        $output->writeln(sprintf('<comment>Generating class <info>"KejawenLab\ApiSkeleton\Repository\%sRepository"</info></comment>', $shortName));
        $this->fileSystem->dumpFile(sprintf('%s/src/Repository/%sRepository.php', $this->kernel->getProjectDir(), $shortName), $repository);
        $output->writeln(sprintf('<comment>Generating class <info>"KejawenLab\ApiSkeleton\%s\Model\%sRepositoryInterface"</info></comment>', $shortName, $shortName));
        $this->fileSystem->dumpFile(sprintf('%s/src/%s/Model/%sRepositoryInterface.php', $this->kernel->getProjectDir(), $shortName, $shortName), $repositoryModel);
    }
}
