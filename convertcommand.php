<?php

namespace Tomjn\Cgconvert;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCommand extends Command {
	protected function configure() {
		$this->setName( 'cgcommand' )
		->setDescription( 'convert from format A to format B ( csv xml and json supported )' )
		->addArgument(
			'input',
			InputArgument::REQUIRED,
			'What input? ( use stdin or a file/filepath )'
		)
		->addArgument(
			'inputtype',
			InputArgument::REQUIRED,
			'What type/format is the input?'
		)
		->addArgument(
			'outputtype',
			InputArgument::REQUIRED,
			'What type/format is the output?'
		)
		->addArgument(
			'output',
			InputArgument::OPTIONAL,
			'What output? Defaults to stdout, pass a target filename to override'
		);
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {
		$inputarg = $input->getArgument( 'input' );
		$outputarg = $input->getArgument( 'output' );
		$input_type = $input->getArgument( 'inputtype' );
		$output_type = $input->getArgument( 'outputtype' );
		if ( $inputarg == 'stdin' ) {
			$inputarg = 'php://stdin';
		}
		if ( ( $outputarg == 'stdout' ) || ( !$outputarg ) ) {
			$outputarg = 'php://stdout';
		}

		$contents = file_get_contents( $inputarg );
		$model = new \Tomjn\Cgconvert\DataModel();
		$inputclass = '\Tomjn\Cgconvert\Input\\'.ucwords( $input_type ).'Input';
		$outputclass = '\Tomjn\Cgconvert\Output\\'.ucwords( $output_type ).'Output';
		$inputobj = new $inputclass( $model );
		$outputobj = new $outputclass( $model );
		$inputobj->process_string( $contents );
		$result = $outputobj->get_string();

		file_put_contents( $outputarg, $result."\n" );
	}
}