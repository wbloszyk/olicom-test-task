<?php

declare(strict_types=1);

namespace App\Command;

use Github\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ApiGithubGetRepositoryCommand extends Command
{
    protected static $defaultName = 'api:github:getRepository';

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Get extended information about a repository by its username and repository name.')
            ->addArgument('login', InputArgument::REQUIRED, 'User login')
            ->addArgument('repository', InputArgument::REQUIRED, 'Repository name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $login = $input->getArgument('login');
        $repository = $input->getArgument('repository');

        if (false === \is_string($login)) {
            $io->warning('Login arguments type must be equal to string.');

            return Command::FAILURE;
        }

        if (false === \is_string($repository)) {
            $io->warning('Login arguments type must be equal to string.');

            return Command::FAILURE;
        }

        $user = $this->client->repo()->show($login, $repository);

        $io->writeln('fullName: '.$user['full_name']);
        $io->writeln('description: '.$user['html_url']);
        $io->writeln('cloneUrl: '.$user['clone_url']);
        $io->writeln('stars: '.$user['stargazers_count']);
        $io->writeln('createdAt: '.$user['created_at']);

        return Command::SUCCESS;
    }
}
