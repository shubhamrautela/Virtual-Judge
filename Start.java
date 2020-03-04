import java.io.*;
import java.lang.ProcessBuilder;
class Start{
	public static void main(String args[]){
	try{
	ProcessBuilder pb= new ProcessBuilder("java","Loop");
	File log= new File("log.txt");	
	pb.redirectOutput(Redirect.appendTo(log));
	Process p=pb.start();
	
	Thread.sleep(10000);
System.out.println("Time limit exceeded");
	p.destroyForcibly();
	}catch(Exception e){}
}
}